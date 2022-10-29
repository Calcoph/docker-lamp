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