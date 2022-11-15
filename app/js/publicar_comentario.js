function publicar_comentario() {
    let comentario = document.form_publicar_comentario.comentario_nuevo.value
    if (comentario != "") {
        document.form_publicar_comentario.submit()
    }
}