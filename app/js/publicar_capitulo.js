function publicar() {
    let titulo = document.form_publicar_capitulo.titulo.value
    let texto = document.form_publicar_capitulo.texto.value

    if (titulo == "") {
        window.alert("No se puede dejar el título vacío")
        return
    }

    if (texto == "") {
        window.alert("No se puede borrar el capítulo vacío")
        return
    }

    document.form_publicar_capitulo.submit()
}

function solo_publicar() {
    document.form_publicar_capitulo.boton.value = "solo_publicar"
    publicar()
}

function publicar_y_seguir() {
    document.form_publicar_capitulo.boton.value = "publicar_y_seguir"
    publicar()
}