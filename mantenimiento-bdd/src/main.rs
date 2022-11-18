use chrono::NaiveDateTime;
use mysql::{prelude::Queryable, params, Pool, PooledConn};
use std::time::{SystemTime, UNIX_EPOCH};

#[derive(Debug)]
struct TokenRaw {
    token: Vec<u8>,
    fecha_validez: String,
}

struct Token {
    token: Vec<u8>,
    fecha_validez: i64, // timestamp
}

impl Token {
    fn print(&self) {
        println!("{:02X?} {}", self.token, self.fecha_validez)
    }
}

fn main() {
    let password = std::fs::read_to_string("/var/db_pass.txt").unwrap();
    let password = urlencoding::encode(&password); // Convierte carácteres especiales como "@" a caracteres de url, en este caso %40
    let url = format!("mysql://admin:{password}@db/database");

    let pool = Pool::new(url.as_str()).unwrap();
    let mut conn = pool.get_conn().unwrap();

    borrar_tokens_caducados(&mut conn);
    reiniciar_intentos_login(&mut conn);
}

fn reiniciar_intentos_login(conn: &mut PooledConn) {
    conn.query_drop("UPDATE usuario SET Intentos=0").unwrap();
}

fn borrar_tokens_caducados(conn: &mut PooledConn) {
    // Obtiene todos los tokens de sesión
    let tokens_sesion_caducados = conn.query_map(
        "SELECT token, fecha_validez FROM session_tokens",
        |(token, fecha_validez)| TokenRaw { token, fecha_validez }
    ).unwrap()
    .into_iter()
    // todos los tokens
    .map(|TokenRaw { token, fecha_validez }| Token { token, fecha_validez: NaiveDateTime::parse_from_str(&fecha_validez, "%Y-%m-%d %H:%M:%S").unwrap().timestamp()})
    // Sólo los caducados
    .filter(|Token { token: _, fecha_validez }| *fecha_validez < (SystemTime::now().duration_since(UNIX_EPOCH).unwrap().as_secs()) as i64).collect::<Vec<_>>();

    // Borrar los tokens csrf conectados a los tokens de sesión que vamos a borrar
    conn.exec_batch(
        "DELETE FROM csrf_tokens WHERE session=:token",
        tokens_sesion_caducados.into_iter().map(|p| params!{
            "token" => &p.token
        })
    ).unwrap();

    let tokens_csrf_caducados = conn.query_map(
        "SELECT token, fecha_validez FROM csrf_tokens",
        |(token, fecha_validez)| TokenRaw { token, fecha_validez }
    ).unwrap()
    .into_iter()
    // todos los tokens
    .map(|TokenRaw { token, fecha_validez }| Token { token, fecha_validez: NaiveDateTime::parse_from_str(&fecha_validez, "%Y-%m-%d %H:%M:%S").unwrap().timestamp()})
    // Sólo los caducados
    .filter(|Token { token: _, fecha_validez }| *fecha_validez < (SystemTime::now().duration_since(UNIX_EPOCH).unwrap().as_secs()) as i64).collect::<Vec<_>>();

    tokens_csrf_caducados.iter().for_each(|t| t.print());
    // Borrar todos los tokens csrf caducados
    conn.exec_batch(
        "DELETE FROM csrf_tokens WHERE token=:token",
        tokens_csrf_caducados.into_iter().map(|p| params!{
            "token" => &p.token
        })
    ).unwrap();
}
