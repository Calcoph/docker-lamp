function registrar_usuario() {
    let email = document.form_inicio_sesion.email.value
    let usuario = document.form_inicio_sesion.usuario.value
    let contraseña = document.form_inicio_sesion.pswd.value
    let contraseña2 = document.form_inicio_sesion.conf_pswd.value

    let regex_email = /.+@.+\..+/ // El regex es poco restrictivo a propósito, algunos regex pre-hechos para email no permiten algunos emails válidos
    if (regex_email.test(email)) {
        if (contraseña == contraseña2) {
            if (contraseña.length <= 20) {
                if (usuario.length <= 20) {
                    document.form_inicio_sesion.submit()
                } else {
                    window.alert("El nombre de usuario es demasiado largo. Usa como mucho 20 caracteres")
                }
            } else {
                // Porque guardamos las contraseñas en texto plano
                window.alert("Las contraseña es demasiado larga. Usa como mucho 20 caracteres")
            }
        } else {
            window.alert("Las contraseñas no coinciden")
        }
    } else {
        window.alert("Email no válido")
    }
}

function iniciar_sesion() {
    let usuario = document.form_inicio_sesion.usuario.value
    let contraseña = document.form_inicio_sesion.pswd.value

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            var contraseña2 = xmlHttp.responseText;
            if (contraseña == contraseña2) {
                console.log("Login successful!")
            }
    }
    let url = window.location.href.split("HTML/inicio_sesion.html")[0];
    xmlHttp.open("GET", url+"PHP/inicio_sesion.php/?username="+usuario, true); 
    xmlHttp.send(null);
}
