function registrar_usuario() {
    let email = document.form_inicio_sesion.email.value
    let usuario = document.form_inicio_sesion.usuario.value
    let contraseña = document.form_inicio_sesion.pswd.value
    let contraseña2 = document.form_inicio_sesion.conf_pswd.value

    let regex_email = /.+@.+\..+/ // El regex es poco restrictivo a propósito, algunos regex pre-hechos para email no permiten algunos emails válidos
    if (!regex_email.test(email)) {
        window.alert("Email no válido")
        return
    }
    if (contraseña != contraseña2) {
        window.alert("Las contraseñas no coinciden")
        return
    }
    if (contraseña.length > 20) {
        // Porque guardamos las contraseñas en texto plano
        window.alert("Las contraseña es demasiado larga. Usa como mucho 20 caracteres")
        return
    }
    if (contraseña.length < 3) {
        window.alert("La contraseña es demasiado corta. Usa como mínimo 3 caracteres")
        return
    }
    if (usuario.length > 20) {
        window.alert("El nombre de usuario es demasiado largo. Usa como mucho 20 caracteres")
        return
    }

    var get_contraseña = new XMLHttpRequest();
    get_contraseña.onreadystatechange = function() {
        if (get_contraseña.readyState == 4 && get_contraseña.status == 200) {
            var contraseña2 = get_contraseña.responseText;
            if (contraseña2 === "") {
                document.form_inicio_sesion.submit()
                document.cookie = "username="+usuario+"; path=/"
            } else {
                window.alert("Ese usuario ya existe")
            }
        }
    }
    let url = window.location.href.split("HTML/register.html")[0];
    get_contraseña.open("GET", url+"PHP/get_contrasena.php/?username="+usuario, true); 
    get_contraseña.send(null);
}

function iniciar_sesion() {
    let usuario = document.form_inicio_sesion.usuario.value
    let contraseña = document.form_inicio_sesion.pswd.value

    var get_contraseña = new XMLHttpRequest();
    get_contraseña.onreadystatechange = function() {
        if (get_contraseña.readyState == 4 && get_contraseña.status == 200) {
            var contraseña2 = get_contraseña.responseText;
            if (contraseña2 === "") {
                window.alert("El ususuario " + usuario + " no existe")
            } else {
                if (contraseña == contraseña2) {
                    console.log("Login successful!")
                    document.cookie = "username="+usuario+"; path=/"
                    document.form_inicio_sesion.submit()
                } else {
                    console.log(contraseña2)
                    window.alert("Contraseña incorrecta")
                }
            }
        }
    }
    let url = window.location.href.split("HTML/inicio_sesion.html")[0];
    get_contraseña.open("GET", url+"PHP/get_contrasena.php/?username="+usuario, true); 
    get_contraseña.send(null);
}
