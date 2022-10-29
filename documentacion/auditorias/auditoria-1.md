# Problemas encontrados
## Problemas encontrados por ZAP
* [Cross site scripting](#Cross-site-scripting-(reflected))
* [SQL Injection](#SQL-Injection)
* [SQL Injection - MySQL](#SQL-Injection-\--MySQL)
* [Application Error Disclosure](#Application-Error-Disclosure)
* [Content Security Policy (CSP) Header Not Set](#Content-Security-Policy-(CSP)-Header-Not-Set)
* [Missing Anti-clickjacking Header](#Missing-Anti\-clickjacking-Header)
* [X-Frame-Options Header Not Set](#X\-Frame\-Options-Header-Not-Set)
* [Absence of Anti-CSRF Tokens](#Absence-of-Anti\-CSRF-Tokens)
* [Server Leaks Information](#Server-Leaks-Information-via-"X\-Powered\-By"-HTTP-Response-Header-Field)
* [X-Content-Type-Options Header Missing](#X\-Content\-Type\-Options-Header-Missing)
* [Information Disclosure](#Information-Disclosure-\--Suspicious-Comments)

### Cross site scripting (reflected)
Esta vulnerabilidad consiste en que un usuario malicioso puede conseguir ejecutar código aribitrariamente desde nuestra
página web, como puede ser insertando el elemento `<script></script>` y conseguiendo que el navegador de otro usuario ejecute ese código.

Archivos afectados:
* /PHP/leer_prologo.php (parámetro titulo)
* /PHP/registro_usuario.php (en todos los parámetros menos contraseña y contraseña2. apellido, dni, email, nombre, pswd, tlf, usuario)
* /PHP/leer_libro.php (parámetros titulo y capitulo)
* /PHP/libro.php (parámetro título)
* /PHP/registro_usuario.php (parámetro fnacimiento)

Esto se debe a que no tratamos los datos que los usuarios nos otorgan (por ejemplo al publicar un libro).
Simplemente los guardamos en la base de datos y los enviamos tal y como son.

### SQL Injection
La vulnerabilidad es parecida a la anterior, en este caso el usuario malicioso puede manipular la forma en la que accedemos a la base de datos,
para que ejecute el comando que desee, o cambiar los parámetros del comando que debería ejecutarse.

Archivos afectados:
* /PHP/leer_libro.php (parámetros titulo y capitulo)
* /PHP/leer_prologo.php (parámetro titulo)

La causa, al igual que en el caso anterior, es no tratar los datos que nos envía el cliente. Por ejemplo, no parametrizamos los comandos, (símplemente los interpolamos en un string).

### SQL Injection - MySQL
*TODO: Explicación del problema*

Archivos afectados:
* /PHP/registro_usuario (todos los parámetros)

### Content Security Policy (CSP) Header Not Set
*TODO: Explicación del problema*

Archivos afectados:
* prácticamente todos

### Missing Anti-clickjacking Header
*TODO: Explicación del problema*

Archivos afectados:
* prácticamente todos

### Application Error Disclosure
*TODO: Explicación del problema*

Archivos afectados:
* /PHP/leer_libro.php (el capítulo 2 del libro "Cinnamon Bun")
### X-Frame-Options Header Not Set
*TODO: Explicación del problema*

Archivos afectado:
* Prácticamente todos.

### Absence of Anti-CSRF Tokens
*TODO: Explicación del problema*

Archivos afectado:
* Prácticamente todos.

### Server Leaks Information via "X-Powered-By" HTTP Response Header Field
*TODO: Explicación del problema*

Archivos afectado:
* Prácticamente todos.

### X-Content-Type-Options Header Missing
*TODO: Explicación del problema*

Archivos afectado:
* Prácticamente todos.

### Information Disclosure - Suspicious Comments
*TODO: Explicación del problema*
*TODO: Explicar por qué a nosotros no nos afecta*
Archivos afectados:
* /js/inicio_sesion.js

#### TODO
Cinnamon bun capitulo 2 da un error

## Problemas encontrados manualmente
*TODO: Formatearlo bien*

* Damos al cliente más información de la que necesita (por ejemplo le enviamos la contraseña del usuario que se intenta registrar para ver si el usuario ya existe)
* Almacenamos las contraseñas en plaintext.
* No utilizamos encryption at rest.
* No parametrizamos los comandos SQL.
* No validamos los datos desde el servidor, sólo desde el cliente.
* Para saber si alguien tiene la sesión iniciada solo miramos la cookie de "username", no verificamos que tenga una contraseña.
* Las sesiones no expiran.
* No escapamos caracteres especiales. Al publicar un libro cualquiera puede meter elementos HTML, incluyendo \<script\>\</script\>.
* No hacemos ninguna verificación sobre el archivo que se supone que es la portada del libro.
    * Ni siquiera miramos si es una imagen.
    * No hay límite de lo grande que puede ser la imagen.
    * Si ya existe una imágen con ese nombre, se sobreescribe.
* Para mirar si la contraseña introducida es la correcta, le enviamos al cliente la contraseña correcta, y el cliente hace la comparación.
* Podría ser un problema que solo miremos que no haya 2 usernames repetidos (tlfs, emails y dnis pueden repetirse).
* No hay límites de accesos por segundo/minuto.
    * Podrían registrar cientos de libros con imágenes enormes, llenando así el disco duro del servidor.
    * Podrían hacerse ataques de fuerza bruta para conseguir la contraseña de un usuario.
* Usamos las credenciales por defecto
    * La contraseña del usuario admin para acceder a la base de datos es *test*
    * La contraseña del usuario admin, dentro de la página en sí, tamibén es *test*
* Usamos una conexión no cifrada (HTTP)
