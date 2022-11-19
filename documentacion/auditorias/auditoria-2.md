# Problemas encontrados
## Problemas encontrados por ZAP
* [Cross site scripting (XSS)](#Cross-site-scripting-(XSS))
* [SQL Injection](#SQL-Injection)
* [Application Error Disclosure](#Application-Error-Disclosure)
* [Content Security Policy (CSP) Header Not Set](#Content-Security-Policy-(CSP)-Header-Not-Set)
* [Missing Anti-clickjacking Header](#Missing-Anti\-clickjacking-Header)
* [X-Frame-Options Header Not Set](#X\-Frame\-Options-Header-Not-Set)
* [Absence of Anti-CSRF Tokens](#Absence-of-Anti\-CSRF-Tokens)
* [Server Leaks Information](#Server-Leaks-Information-via-"X\-Powered\-By"-HTTP-Response-Header-Field)
* [X-Content-Type-Options Header Missing](#X\-Content\-Type\-Options-Header-Missing)
* [Information Disclosure](#Information-Disclosure-\--Suspicious-Comments)

### Cross site scripting (XSS)
Arreglado (Diego Esteban)

### SQL Injection
Arreglado (Diego Esteban y Francisco González)

### Content Security Policy (CSP) Header Not Set
No Arreglado

### Missing Anti-clickjacking Header
No Arreglado

### Application Error Disclosure
No arreglado

### X-Frame-Options Header Not Set
No arreglado

### Absence of Anti-CSRF Tokens
Arreglado (Diego Esteban)
### Server Leaks Information via "X-Powered-By" HTTP Response Header Field
No arreglado

### X-Content-Type-Options Header Missing
No arreglado

### Information Disclosure - Suspicious Comments
Arreglado (no había que hacer nada)
## Problemas encontrados manualmente
* [Rotura del control de acceso](#Rotura-del-control-de-acceso)
* [Fallos criptográficos](#Fallos-criptográficos)
* [Inyección](#Inyección)
* [Diseño inseguro](#Diseño-inseguro)
* [Configuración de seguridad insuficiente](#Configuración-de-seguridad-insuficiente)
* [Componentes vulnerables y obsoletos](#Componentes-vulnerables-y-obsoletos)

# Rotura de control de acceso

* Para mirar si la contraseña introducida es la correcta, le enviamos al cliente la contraseña correcta, y el cliente hace la comparación. (Arreglado. Diego Esteban)
* Para saber si alguien tiene la sesión iniciada solo miramos la cookie de "username", no verificamos que tenga una contraseña. (Arreglado. Diego Esteban)
* No logueamos los intentos de inicio de sesión. (Arreglado. Francisco González)
* No generamos tokens de sesión (Arreglado. Diego Esteban)

# Fallos criptográficos

* Usamos una conexión no cifrada (HTTP) (Arreglado. Diego Esteban)
* No utilizamos encryption at rest. [Arreglado, parcialmente (Solo se encuentra encriptada la información del usuario). Francisco González]
* Almacenamos las contraseñas en plaintext. (Arreglado. Diego Esteban)

# Inyección

* No hacemos ninguna verificación sobre el archivo que se supone que es la portada del libro. (Arreglado, Francisco González)
    * Ni siquiera miramos si es una imagen.
    * No hay límite de lo grande que puede ser la imagen.
    * Si ya existe una imágen con ese nombre, se sobreescribe.
* No parametrizamos los comandos SQL. (Arreglado, Diego Esteban y Francisco González)
* No validamos los datos desde el servidor, sólo desde el cliente. (Arreglado Diego Esteban y Francisco Gonzalez)
* No escapamos caracteres especiales. Al publicar un libro cualquiera puede meter elementos HTML, incluyendo \<script\>\</script\>. (Arreglado. Diego Esteban)
    * Esto incluye los nombres de usuario. Al publicar un comentario, inserta su nombre de usuario en él, lo cual puede ser cualquier string. (Arreglado. Diego Esteban)

# Diseño inseguro
* No hay límites de intentos de inicio de sesión.(Francisco González)
* No hay límites de accesos por segundo/minuto.
    * Podrían registrar cientos de libros con imágenes enormes, llenando así el disco duro del servidor.
    * Podrían hacerse ataques de fuerza bruta para conseguir la contraseña de un usuario. (Arreglado. Francisco Gonzalez( No estoy Seguro))
    * Podrían registrarse miles de cuentas falsas o "bots" (Arreglado. Francisco González)
* Damos al cliente más información de la que necesita (por ejemplo le enviamos la contraseña del usuario que se intenta registrar para ver si el usuario ya existe) (Arreglado)
* Podría ser un problema que solo miremos que no haya 2 usernames repetidos (tlfs, emails y dnis pueden repetirse). (No arreglado)
* No se existe una configuración mínima de contraseña (Arreglado, Francisco González).
# Configuración de seguridad insuficiente
* Usamos las credenciales por defecto (Arreglado)
    * La contraseña del usuario admin para acceder a la base de datos es *test* (Arreglado . Diego Esteban)
    * La contraseña del usuario admin, dentro de la página en sí, también es *test* (Arreglado. Diego Esteban)

# Componentes vulnerables y obsoletos

* Usamos la versión "latest" de phpmyadmin, en vez de una versión concreta (Arreglado. Diego Esteban)



