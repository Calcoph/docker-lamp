# Problemas encontrados
## Problemas encontrados por ZAP
* [Cross site scripting](#Cross-site-scripting-(reflected))
* [SQL Injection](#SQL-Injection)
* [Application Error Disclosure](#Application-Error-Disclosure)
* [Content Security Policy (CSP) Header Not Set](#Content-Security-Policy-(CSP)-Header-Not-Set)
* [Missing Anti-clickjacking Header](#Missing-Anti\-clickjacking-Header)
* [X-Frame-Options Header Not Set](#X\-Frame\-Options-Header-Not-Set)
* [Absence of Anti-CSRF Tokens](#Absence-of-Anti\-CSRF-Tokens)
* [Server Leaks Information](#Server-Leaks-Information-via-"X\-Powered\-By"-HTTP-Response-Header-Field)
* [X-Content-Type-Options Header Missing](#X\-Content\-Type\-Options-Header-Missing)
* [Information Disclosure](#Information-Disclosure-\--Suspicious-Comments)

### Cross site scripting (reflected)
Arreglado

### SQL Injection
Arreglado

### Content Security Policy (CSP) Header Not Set
*TODO: Explicación del problema*

Archivos afectados:
* prácticamente todos

### Missing Anti-clickjacking Header
*TODO: Explicación del problema*

Archivos afectados:
* prácticamente todos

### Application Error Disclosure
Nuestra página web a veces falla. Cuando estos fallos ocurren, le enviamos la información muy específica del fallo al usuario, que no necesita tener tanta información. Un atacante puede hacer fallar la página web a propósito para obtener información sobre qué sistemas estamos utilizando, lo cual le facilita para saber qué vulnerabilidades puede tener.

Archivos afectados:
* /PHP/leer_libro.php (el capítulo 2 del libro "Cinnamon Bun", este capítulo contiene caracteres especiales sin escapar)

Cuando ocurre un error deberíamos enviar un código de error genérico.
### X-Frame-Options Header Not Set
*TODO: Explicación del problema*

Archivos afectado:
* Prácticamente todos.

### Absence of Anti-CSRF Tokens
*TODO: Explicación del problema*

Archivos afectado:
* Prácticamente todos.

### Server Leaks Information via "X-Powered-By" HTTP Response Header Field
Nuestras respuestas HTTP contienen metadatos que informan al cliente de la tecnología que estamos utilizando. Esta información no es necesaria para el cliente, pero un atacante puede utilizarla para saber que vulnerabilidades puede tener nuestro sistema.

Archivos afectado:
* Prácticamente todos.

### X-Content-Type-Options Header Missing
*TODO: Explicación del problema*

Archivos afectado:
* Prácticamente todos.

### Information Disclosure - Suspicious Comments
En un fichero javascript, le damos el valor a la cookie "username". Esto puede ser un problema porque un atacante puede saber para qué es la cookie.

Por otro lado, el uso de la cookie es trivial de entender, puesto que se ve a simple vista que en la cookie se guarda el nombre de usuario. Por lo tanto no es un gran problema.

Archivos afectados:
* /js/inicio_sesion.js

#### TODO
Cinnamon bun capitulo 2 da un error

## Problemas encontrados manualmente

# Rotura de control de acceso

* Para mirar si la contraseña introducida es la correcta, le enviamos al cliente la contraseña correcta, y el cliente hace la comparación.
* Para saber si alguien tiene la sesión iniciada solo miramos la cookie de "username", no verificamos que tenga una contraseña.
* No logueamos los intentos de inicio de sesión.
* No generamos tokens de sesión

# Fallos criptográficos

* Usamos una conexión no cifrada (HTTP)
* No utilizamos encryption at rest.
* Almacenamos las contraseñas en plaintext.

# Inyección

* No hacemos ninguna verificación sobre el archivo que se supone que es la portada del libro.
    * Ni siquiera miramos si es una imagen.
    * No hay límite de lo grande que puede ser la imagen.
    * Si ya existe una imágen con ese nombre, se sobreescribe.
* No parametrizamos los comandos SQL.
* No validamos los datos desde el servidor, sólo desde el cliente.
* No escapamos caracteres especiales. Al publicar un libro cualquiera puede meter elementos HTML, incluyendo \<script\>\</script\>.
 * Esto incluye los nombres de usuario. Al publicar un comentario, inserta su nombre de usuario en él, lo cual puede ser cualquier string.

# Diseño inseguro

* No hay límites de accesos por segundo/minuto.
    * Podrían registrar cientos de libros con imágenes enormes, llenando así el disco duro del servidor.
    * Podrían hacerse ataques de fuerza bruta para conseguir la contraseña de un usuario.
* Damos al cliente más información de la que necesita (por ejemplo le enviamos la contraseña del usuario que se intenta registrar para ver si el usuario ya existe)
* Podría ser un problema que solo miremos que no haya 2 usernames repetidos (tlfs, emails y dnis pueden repetirse).

# Configuración de seguridad insuficiente

* Usamos las credenciales por defecto
    * La contraseña del usuario admin para acceder a la base de datos es *test*
    * La contraseña del usuario admin, dentro de la página en sí, también es *test*

# Componentes vulnerables y obsoletos

* Usamos la versión "latest" de phpmyadmin, en vez de una versión concreta
