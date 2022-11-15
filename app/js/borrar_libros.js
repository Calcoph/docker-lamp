function borrar_libros() {
    // Copiado de https://stackoverflow.com/questions/19010177/javascript-get-form-array-values
    var libros = document.querySelectorAll("#form_borrar_libros input[name='libros_borrados[]']");
    var alguno_seleccionado = false
    for (i = 0; i < libros.length; i++) {
        let libro = libros[i];
        if (libro.checked) {
            alguno_seleccionado = true
            break
        }
    }
    if (alguno_seleccionado) {
        if (confirm("Estás seguro de que quieres eliminar permanentemente estos libros?")) {
            document.form_borrar_libros.submit()
        }
    } else {
        window.alert("Selecciona algún libro")
        return
    }
}