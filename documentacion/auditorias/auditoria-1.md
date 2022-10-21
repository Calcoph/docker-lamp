# Problemas encontrados
## Problemas encontrados por ZAP
* [Cross site scripting](#Cross-site-scripting-(reflected))
* [Application Error Disclosure](#Application-Error-Disclosure)
* [X-Frame-Options Header Not Set](#X\-Frame\-Options-Header-Not-Set)
* [Absence of Anti-CSRF Tokens](#Absence-of-Anti\-CSRF-Tokens)
* [Server Leaks Information](#Server-Leaks-Information-via-"X\-Powered\-By"-HTTP-Response-Header-Field)
* [Timestamp Disclosure](#Timestamp-Disclosure-\--UNIX)
* [X-Content-Type-Options Header Missing](#X\-Content\-Type\-Options-Header-Missing)
* [Information Disclosure](#Information-Disclosure-\--Suspicious-Comments)

### Cross site scripting (reflected)
*TODO: Explicación del problema*

Archivos afectados:
* /PHP/leer_prologo.php (parámetro titulo)
* /PHP/registro_usuario.php (en todos los parámetros menos contraseña y contraseña2. apellido, dni, email, nombre, pswd, tlf, usuario)
* /PHP/leer_libro.php (parámetros titulo y capitulo)
* /PHP/libro.php (parámetro título)
* /PHP/registro_usuario.php (parámetro fnacimiento)
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

### Timestamp Disclosure - UNIX
*TODO: Explicación del problema*
*TODO: Explicar por qué a nosotros no nos afecta*

Archivos afectados:
* /HTML/register.html
* /js/inicio_sesion.js

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