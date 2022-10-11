function registrar_usuario() {
    let email = document.form_inicio_sesion.email.value
    let usuario = document.form_inicio_sesion.usuario.value
    let contraseña = document.form_inicio_sesion.pswd.value
    let contraseña2 = document.form_inicio_sesion.conf_pswd.value
    let nombre = document.form_inicio_sesion.nombre.value
    let apellido = document.form_inicio_sesion.apellido.value
    let tel = document.form_inicio_sesion.tlf.value
    let patternTel= /[0-9]{9}/
    let pattern = new RegExp('^[A-Z]+$', 'i'); // Expresión regular de solo letras
    let regex_email = /.+@.+\..+/ // El regex es poco restrictivo a propósito, algunos regex pre-hechos para email no permiten algunos emails válidos
    if(!pattern.test(nombre)){
        alert("Nombre no válido, porfavor utilice solo letras");
    }
    else{
        if(!pattern.test(apellido)){
            alert("apellido no válido, porfavor utilice solo letras");
        }
        else{
            if(!validarDNI()){
                return
            }
            else{
                //fecha
                if(!validarFecha()){
                    return
                }
                else{
                    //telefono
                    if (!patternTel.test(tel)) {
                        window.alert("Teléfono no válido")
                        return}

                    else{
                        if (!regex_email.test(email)) {
                            window.alert("Email no válido")
                            return
                        }
                        else{
                            if (contraseña != contraseña2) {
                                window.alert("Las contraseñas no coinciden")
                                return
                            }
                            else{
                                if (contraseña.length > 20) {
                                    // Porque guardamos las contraseñas en texto plano
                                    window.alert("Las contraseña es demasiado larga. Usa como mucho 20 caracteres")
                                    return
                                }
                                else{
                                    if (contraseña.length < 3) {
                                        window.alert("La contraseña es demasiado corta. Usa como mínimo 3 caracteres")
                                        return
                                    }
                                    else{
                                        if (usuario.length > 20) {
                                            window.alert("El nombre de usuario es demasiado largo. Usa como mucho 20 caracteres")
                                            return
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }    
        }
    }
   
    
    
    
    if (usuario.length > 20) {
        window.alert("El nombre de usuario es demasiado largo. Usa como mucho 20 caracteres")
        registrar=false;
        return
    }

    var get_contraseña = new XMLHttpRequest();
    get_contraseña.onreadystatechange = function() {
        if (get_contraseña.readyState == 4 && get_contraseña.status == 200) {
            var contraseña2 = get_contraseña.responseText;
            if (contraseña2 === "") {
                document.form_inicio_sesion.submit()
                document.cookie = "username="+usuario+"; path=/"
            } else {
                window.alert("Ese usuario ya existe")
            }
        }
    }
    let url = window.location.href.split("HTML/register.html")[0];
    get_contraseña.open("GET", url+"PHP/get_contrasena.php/?username="+usuario, true); 
    get_contraseña.send(null);}

function validarFecha(){
    let fecha = document.form_inicio_sesion.fnacimiento.value
    let patternFecha = /[0-9]{4}-[0-9]{2}-[0-9]{2}/;
    var mes31 =[1,3,5,7,8,10,12]
    var mes30 = [4,6,9,11]
    if(patternFecha.test(fecha)){
        anno = parseInt(fecha.substr(0,4))
        mes = parseInt(fecha.substr(5,2))
        dia = parseInt(fecha.substr(8,2))

        if(anno<=2022){
            if(mes31.includes(mes)){
                if(dia>0 && dia<=31 ){
                    return true
                }
                else{
                    alert("fecha incorrecta")
                    return false
                }
               
            }
            else{
                if(mes30.includes(mes)){
                    if(dia>0 && dia<=30 ){
                        return true
                    }
                    else{
                        alert("fecha incorrecta")
                        return false
                    }
                   
                }
                else{
                    if(anno%400==0 || (anno%4==0 && anno%100!=0)){
                        if(mes==2){
                            if(dia>0 && dia<=29 ){
                                return true
                            }
                            else{
                                alert("fecha incorrecta")
                                return false
                            }
                        }

                    }
                    else{
                       if(mes==2){
                            if(dia>0 && dia<=28 ){
                                return true
                            }
                                else{
                                    alert("fecha incorrecta")
                                    return false
                                } 
                        }
                    }
                    
                    
                    
                }
            }
        }
    }   
    else{
        alert("fecha incorrecta")
        return false;
    }   
} 

function validarDNI(){
    let dni = document.form_inicio_sesion.dni.value
    expresion_regular_dni = /^\d{8}-[a-zA-Z]$/; //Expresion regular de un DNI
    if(expresion_regular_dni.test(dni)){
        numero= dni.substr(0,dni.length-2);
        letr = dni.substr(dni.length-1,1);
        numero = numero % 23;
        letra='TRWAGMYFPDXBNJZSQVHLCKET'; // Alfabeto con el cual se calcula la letra del DNI
        letra=letra.substring(numero,numero+1);
        if (letra!=letr.toUpperCase()) {
            alert('Dni erroneo, la letra del DNI no se corresponde');
            return false
        }else{
            return true
        }
        }
        else{
            alert('Dni erroneo, formato no válido');
            return false
        }
    }

function iniciar_sesion() {
    let usuario = document.form_inicio_sesion.usuario.value
    let contraseña = document.form_inicio_sesion.pswd.value
    var get_contraseña = new XMLHttpRequest();
    get_contraseña.onreadystatechange = function() {
        if (get_contraseña.readyState == 4 && get_contraseña.status == 200) {
            var contraseña2 = get_contraseña.responseText;
            if (contraseña2 === "") {
                window.alert("El ususuario " + usuario + " no existe")
            } else {
                if (contraseña == contraseña2) {
                    console.log("Login successful!")
                    document.cookie = "username="+usuario+"; path=/"
                    document.form_inicio_sesion.submit()
                } else {
                    console.log(contraseña2)
                    window.alert("Contraseña incorrecta")
                }
            }
        }
    }
    let url = window.location.href.split("HTML/inicio_sesion.html")[0];
    get_contraseña.open("GET", url+"PHP/get_contrasena.php/?username="+usuario, true); 
    get_contraseña.send(null);
}
