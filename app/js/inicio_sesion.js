function registrar_usuario() {
    let email = document.form_inicio_sesion.email.value
    //let usuario = document.form_inicio_sesion.usuario.value
    let contraseña = document.form_inicio_sesion.pswd.value
    let contraseña2 = document.form_inicio_sesion.conf_pswd.value

    let regex_email = /.+@.+\..+/ // El regex es poco restrictivo a propósito, algunos regex pre-hechos para email no permiten algunos emails válidos
    if (regex_email.test(email)) {
        if (contraseña == contraseña2) {
            document.form_inicio_sesion.submit()
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
}