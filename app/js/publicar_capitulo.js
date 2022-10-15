function publicar() {
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