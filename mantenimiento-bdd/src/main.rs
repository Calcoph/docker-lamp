#[tokio::main]
async fn main() {
    let password = std::fs::read_to_string("../db_pass.txt").unwrap();
    let url = format!("mysql://admin:{password}@db/database");

    let pool = mysql_async::Pool::new(url.as_str());
    let mut conn = pool.get_conn().await.unwrap();
}
