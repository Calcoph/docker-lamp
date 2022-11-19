# Problemas arreglados desde la auditoría 1
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
Arreglado por Diego Esteban

La solución ha sido escapar los caracteres especiales de cualquier cosa que venga desde una petición HTTP. Ya sea los atributos de una petición GET, POST o una cookie. De esta manera, cualquier cosa sobra la que no tenemos control directo se trata como texto plano, no se puede tratar como código. esto lo hace la función htmlspecialchars() de PHP.

### SQL Injection
Arreglado por Diego Esteban y por Francisco González

Las inyecciones SQL se han arreglado utilizando queries paramterizadas. De esta manera, se separa la estructura de las consultas SQL de sus parámetros. Así se consigue que no se pueda modificar la estructura de la consulta mediante parámteros maliciosos que controla el usuario.

### Content Security Policy (CSP) Header Not Set
No Arreglado

### Missing Anti-clickjacking Header
No Arreglado

### Application Error Disclosure
No arreglado

### X-Frame-Options Header Not Set
No arreglado

### Absence of Anti-CSRF Tokens
Arreglado por Diego Esteban

Hemos implantado un sistema de tokens, en el que se guarda un token de sesión en las cookies del usuario. Gracias a esto, cuando le enviamos un form a un usuario, generamos aleatoriamente otro token vinculado a su token de sesión. Ambos tokens son válidos solo durante un periodo de tiempo, los de sesión 12 horas y los anti-csrf 1 hora. Ambos tienen una longitud de 32 bytes.

Cuando recibimos una respuesta de un form, verificamos que su token anti-csrf está vinculado a la cookie de sesión del usuario.

Con este sistema, no puede una tercera persona usar un form que se le ha servido para que lo rellene otro. Solo el usuario que ha pedido el form puede rellenarlo.

Al usar tokens de sesión no es necesario que un usuario haya iniciado sesión, si no tiene un token de sesión, se le otorga uno cuando lo necesite.

Cada 30 minutos se eliminan de la base de datos los tokens inválidos, aun así, se verifica cada vez que el token no haya expirado.

### Server Leaks Information via "X-Powered-By" HTTP Response Header Field
Arreglado por Diego Esteban

Esto tenía fácil solución. Basta con añadir `expose_php = Off` a php.ini

### X-Content-Type-Options Header Missing
No arreglado

### Information Disclosure - Suspicious Comments
Como mencionamos en la auditoría 1, este problma no es relevante, se trata de un falso positivo.

## Problemas encontrados manualmente
* [Rotura del control de acceso](#Rotura-del-control-de-acceso)
* [Fallos criptográficos](#Fallos-criptográficos)
* [Inyección](#Inyección)
* [Diseño inseguro](#Diseño-inseguro)
* [Configuración de seguridad insuficiente](#Configuración-de-seguridad-insuficiente)
* [Componentes vulnerables y obsoletos](#Componentes-vulnerables-y-obsoletos)

# Rotura de control de acceso

### No logueamos los intentos de inicio de sesión.
Arreglado por Francisco González

### No generamos tokens de sesión
Arreglado por Diego Esteban

Como hemos mencionado [anteriormente](#Content-Security-Policy-(CSP)-Header-Not-Set), ahora usamos tokenes de sesión, por lo que todo el sistema de login se hace desde el lado del servidor. El usuario envía su contraseña (encriptada por HTTPS), y el servidor la hashea. Si la validación es correcta se le asigna su usuario a su token de sesión.

Nos hemos asegurado de que aunque el usuario cambie su nombre de usuario, el token lo tendrá en cuenta. De este modo no puede usar su token para conectare a una cuenta con su antiguo nombre.

### Para mirar si la contraseña introducida es la correcta, le enviamos al cliente la contraseña correcta, y el cliente hace la comparación. 
Arreglado por Diego Esteban

Una vez más, el sistema de tokens de sesión soluciona este problema.

### Para saber si alguien tiene la sesión iniciada solo miramos la cookie de "username", no verificamos que tenga una contraseña.
Arreglado por diego Esteban

Una vez más, el sistema de tokens de sesión soluciona este problema.

# Fallos criptográficos

### Usamos una conexión no cifrada (HTTP)
Arreglado por Diego Esteban

Para acceder a la página web con https basta con entrar en https://localhost:444

Es posible entrar con http mediante http://localhost:81 ya que nuestro certificado no está firmado por un CA y es incómodo. Pero si fuésemos a usar esta página web de verdad, no deberíamos permitir que se use una conexión http, ya que la contraseña se envía en texto plano.

### No utilizamos encryption at rest.
Arreglado por Francisco González

Parcialmente. Solo se encuentra encriptada la información sensible del usuario.

### Almacenamos las contraseñas en plaintext.
Arreglado por Diego Esteban. Ibai ha cambiado el campo contraseña de varchar(50) a varchar(60)

Utilizamos las funciones de PHP password_verify() y password_hash(). De este modo almacenamos tanto el hash en sí como la sal en un solo string, que en total ocupa 60 caracteres, por eso hemos tenido que ampliar el tamaño del campo de la base de datos.

Usamos el algoritmo CRYPT_BLOWFISH, que está pensado para hashear contraseñas y es seguro.

# Inyección

* No hacemos ninguna verificación sobre el archivo que se supone que es la portada del libro. (Arreglado, Francisco González)
    * Ni siquiera miramos si es una imagen.
    * No hay límite de lo grande que puede ser la imagen.
    * Si ya existe una imágen con ese nombre, se sobreescribe.
### No parametrizamos los comandos SQL.
Arreglado, ver [inyección SQL](#SQL-Injection).

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



