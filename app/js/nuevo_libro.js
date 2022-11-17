function publicar() {
    let titulo = document.form_publicar_libro.titulo.value
    let descripcion = document.form_publicar_libro.descripcion.value
    let resumen = document.form_publicar_libro.resumen.value
    let texto = document.form_publicar_libro.texto.value
    let portada = document.form_publicar_libro.portada.value
    let portada_personalizada = document.form_publicar_libro.portada_personalizada.value

    if (!valido(titulo, descripcion, resumen, texto, portada, portada_personalizada)) {
        return
    }

    // Código obtenido de https://stackoverflow.com/questions/247483/http-get-request-in-javascript
    // Modificaciones: la URL, y la función de callback
    var get_titulo = new XMLHttpRequest();
    get_titulo.onreadystatechange = function () {
        if (get_titulo.readyState == 4 && get_titulo.status == 200) {
            var titulo2 = get_titulo.responseText;
            if (titulo2 === "") {
                document.form_publicar_libro.submit()
            } else {
                window.alert("Ya existe un libro con ese título")
            }
        }
    }

    llamar_get_titulo(get_titulo, titulo)
}

function modificar() {
    let titulo = document.form_modificar_libro.titulo.value
    let descripcion = document.form_modificar_libro.descripcion.value
    let resumen = document.form_modificar_libro.resumen.value
    let texto = document.form_modificar_libro.texto.value
    let portada = document.form_modificar_libro.portada.value
    let portada_personalizada = document.form_modificar_libro.portada_personalizada.value
    let titulo_anterior = document.form_modificar_libro.titulo_anterior.value

    if (!valido(titulo, descripcion, resumen, texto, portada, portada_personalizada)) {
        return
    }

    // Código obtenido de https://stackoverflow.com/questions/247483/http-get-request-in-javascript
    // Modificaciones: la URL, y la función de callback
    var get_titulo = new XMLHttpRequest();
    get_titulo.onreadystatechange = function () {
        if (get_titulo.readyState == 4 && get_titulo.status == 200) {
            var titulo2 = get_titulo.responseText;
            if (titulo2 === "") {
                document.form_modificar_libro.submit()
            } else if (titulo != titulo_anterior) {
                window.alert("Ya existe un libro con ese título")
            } else {
                document.form_modificar_libro.submit()
            }
        }
    }

    llamar_get_titulo(get_titulo, titulo)
}

function llamar_get_titulo(get_titulo, titulo) {
    // Código obtenido de https://stackoverflow.com/questions/247483/http-get-request-in-javascript
    // Modificaciones: la URL, y la función de callback
    var pre = ""
    var url = window.location.href.split("http://")[1]; // por si acaso
    if (url === undefined) { // Por si no tiene http://
        url = window.location.href
    } else {
        pre = "http://"
    }
    var url1 = url.split("https://")[1]; // por si acaso
    if (url1 === undefined) { // Por si no tiene https://
        url1 = url
    } else {
        pre = "https://"
    }
    url = url1.split("/")[0]; // Asumo que la url será lo que haya antes del primer / (habiendo eliminado https:// y http://)
    get_titulo.open("GET", pre + url + "/PHP/get_titulo.php/?titulo=" + titulo, true);
    get_titulo.send(null);
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