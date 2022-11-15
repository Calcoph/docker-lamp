function publicar() {
    let titulo = document.form_publicar_capitulo.titulo.value
    let texto = document.form_publicar_capitulo.texto.value

    if (valido(titulo, texto)) {
        document.form_publicar_capitulo.submit()
    }
}

function modificar() {
    let titulo = document.form_modificar_capitulo.titulo.value
    let texto = document.form_modificar_capitulo.texto.value

    if (valido(titulo, texto)) {
        document.form_modificar_capitulo.submit()
    }
}

function valido(
    titulo,
    texto
) {
    if (titulo == "") {
        window.alert("No se puede dejar el título vacío")
        return false
    }

    if (texto == "") {
        window.alert("No se puede borrar el capítulo vacío")
        return false
    }

    return true
}

function solo_publicar() {
    document.form_publicar_capitulo.boton.value = "solo_publicar"
    publicar()
}

function publicar_y_seguir() {
    document.form_publicar_capitulo.boton.value = "publicar_y_seguir"
    publicar()
}