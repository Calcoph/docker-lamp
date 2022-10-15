function publicar() {
    let titulo = document.form_publicar_libro.titulo.value
    let descripcion = document.form_publicar_libro.descripcion.value
    let resumen = document.form_publicar_libro.resumen.value
    let texto = document.form_publicar_libro.texto.value
    let portada = document.form_publicar_libro.portada.value
    let portada_personalizada = document.form_publicar_libro.portada_personalizada.value

    if (!descripcion) {
        window.alert("Añade una descripción")
        return
    }

    if (!resumen) {
        window.alert("Añade un resumen")
        return
    }

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

function solo_publicar() {
    document.form_publicar_libro.boton.value = "solo_publicar"
    publicar()
}

function publicar_y_seguir() {
    document.form_publicar_libro.boton.value = "publicar_y_seguir"
    publicar()
}