function publicar() {
    let titulo = document.form_publicar_libro.titulo.value
    let descripcion = document.form_publicar_libro.descripcion.value
    let resumen = document.form_publicar_libro.resumen.value
    let texto = document.form_publicar_libro.texto.value
    let portada = document.form_publicar_libro.portada.value
    let portada_personalizada = document.form_publicar_libro.portada_personalizada.value

    if (valido(titulo, descripcion, resumen, texto, portada, portada_personalizada)) {
        document.form_publicar_libro.submit()
    }
}

function modificar() {
    let titulo = document.form_modificar_libro.titulo.value
    let descripcion = document.form_modificar_libro.descripcion.value
    let resumen = document.form_modificar_libro.resumen.value
    let texto = "a" // TODO: cambiarlo por document.form_modificar_libro.texto.value
    let portada = document.form_modificar_libro.portada.value
    let portada_personalizada = document.form_modificar_libro.portada_personalizada.value

    if (valido(titulo, descripcion, resumen, texto, portada, portada_personalizada)) {
        document.form_modificar_libro.submit()
    }
}

function valido(
    titulo,
    descripcion,
    resumen,
    texto,
    portada_personalizada,
    portada
) {
    if (!descripcion) {
        window.alert("Añade una descripción")
        return false
    }

    if (!resumen) {
        window.alert("Añade un resumen")
        return false
    }

    if (!titulo) {
        window.alert("El libro necesita un título")
        return false
    }

    if (!texto) {
        window.alert("El libro está vacío")
        return false
    }

    if (!portada_personalizada) {
        if (!portada) {
            window.alert("Debes elegir una portada")
            return false
        }
    }

    return true
}

function solo_publicar() {
    document.form_publicar_libro.boton.value = "solo_publicar"
    publicar()
}

function publicar_y_seguir() {
    document.form_publicar_libro.boton.value = "publicar_y_seguir"
    publicar()
}