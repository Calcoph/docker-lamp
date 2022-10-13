function publicar() {
    let titulo = document.form_publicar_libro.titulo.value
    let texto = document.form_publicar_libro.texto.value
    let portada = document.form_publicar_libro.portada.value
    let portada_personalizada = document.form_publicar_libro.portada_personalizada.value

    if (!titulo) {
        window.alert("El libro necesita un título")
        return
    }

    if (!texto) {
        window.alert("El libro está vacío")
        return
    }

    if (!portada_personalizada) {
        if (!portada) {
            window.alert("Debes elegir una portada")
            return
        }
    }

    document.form_publicar_libro.submit()
}
