### Para ver cómo iniciar la web, véase el [README](https://github.com/Calcoph/librerium/blob/master/README.md)

Hecho por: Francisco González, Diego Esteban, Ibai Mendivil.

# Diagrama de páginas

![diagrama de páginas]

# Pantalla 1: Inicio
![inicio]
Desde esta pantalla podremos:
 * Acceder al catálogo (**Botón 1**)
 * Iniciar sesión o acceder a las opciones de usuario, dependiendo si hemos iniciados esión o no. (**Botón 2**)

En casi todas las demás páginas habrá una cabecera (ilustración 1) con el que se puede volver a esta página (**Botón 3**), el header también contiene el **Botón 2**.

![cabecera]
##### Ilustración 1

# Pantalla 2: Catálogo
![catalogo]
En el catálogo se muestran todos los libros. Justo a una descripción corta de los mismos.

Si pinchamos en algun título, nos llevará a la pantalla del libro.

# Pantalla 2.1: Libro
![libro]
Aquí se muestra la portada del libro, junto a su título y descripción.

Al pulsar el **Botón 1**, Empezaremos a leer el primer capítulo.

También tenemos la opción de enviar un comentario **Botón 2**, para lo que tendremos que haber iniciado sesión previamente, de no ser así se nos pedirá iniciar sesión al pulsar el botón.

En la parte inferior de la página, se muestran los comentarios.

# Pantalla 2.2: Lectura
![capitulo]
Al igual que los libros, cada capítulo también tiene comentarios. Pero están temporalmente deshabilitados para evitar spoilers.

![cap_botones]
Para avanzar y retroceder los capítulos, se pueden utilizar el **Botón 1** y el **Botón 2**, respectivamente.

# Pantalla 3: Inicio sesión
![inicio_sesion]
Como es esperable, puedes iniciar sesión pulsando el **Botón 1**. En caso de no tener una cuenta, puedes registrar una pulsando el **Botón 2**.

# TODO: Registro
Para registrarse, es necesario rellenar todos los campos, con los formatos especificados en cada uno de ellos.
En caso de que algún campo no sea válido, se le avisará al usuario. Al pulsar el **Botón 1** se hacen las comprobaciones y
se registra el usuario si son correctas. Se puede volver a la pantalla de iniciar sesión pulsando el **Botón 2**.

# Pantalla 4: opciones de usuario
![ajustes_usuario]
En esta pantalla, que se accede pulsando sobre el username de la cabecera, se le mostrarán al usuario las siguientes funciones:
 * Cerrar sesión (**Botón 1**)
 * Cambiar datos (**Botón 2**)
 * Borrar un libro (**Botón 3**)
 * Modificar un libro (**Botón 4**)

Sólo se puede acceder si se ha iniciado la sesión.

# Pantalla 4.1: modificar libros
![modificar_libros]
Se muestra la lista de todos los libros *escritos por el suuario que ha iniciado sesión*.
Puede leer los libros haciendo click sobre sus títulos, también tiene la opción de modificar sus datos o añadir nuevos capítulos a los mismos.

# Pantalla 4.1.1: Modificar libro
![modificar_libro]
Al modificar un libro, los campos se rellenarán con los datos actuales, incluyendo la portada, en la que se marcará la opción de "no modificar".
Al igual que al publicar libros, si se selecciona una portada personalizada, se ignorará la elección en los botones radio.

Desde aquí, se nos mostrarán los capítulos del libro. Para modificarlos tendremos que pinchar en su número.

# Pantalla 4.1.1.1: Modificar capitulo
![modificar_capitulo]


# Pantalla 4.1.2: Nuevo capitulo
![nuevo_capitulo]

# Pantalla 4.2: Borrar libros
![borrar_libros]
Aquí el usuario puede eliminar de la web un libro suyo clickando sobre la checkbox correspondiente y luego dándole al botón de borrar.

# Pantalla 5: Introducir un nuevo libro
![Nuevo_libro]
Un usuario que esté identificado, mediante este apartado, puede añadir al catálogo un nuevo libro.
Cuando se introduzca la información necesaria para publicar un libro, se da la opción ( mediante los botones ) de publicarlo, o seguir escribiendo el siguiente capítulo.

# Pantalla 4.3: Modificar datos usuario
![cambiar_datos]
En esta pestaña el usuario puede modificar todos sus datos. Como se ve en la ilustración, los campos aparecen con los datos actuales. Para que los cambios se ejecuten, se deberá pulsar sobre el botón **Cambiar datos**

# Fuentes
* Imágenes: https://pixabay.com/es/
* Scrollbar: https://www.jose-aguilar.com/blog/scrollbar-vertical-horizontal/
* Validar DNI: https://donnierock.com/2011/11/05/validar-un-dni-con-javascript/
* Ocultar contraseñas: https://es.acervolima.com/como-ocultar-la-contrasena-en-html/
* Propiedad Display CSS: https://uniwebsidad.com/libros/css-avanzado/capitulo-4/propiedad-display
* HTML y CSS: https://www.youtube.com/watch?v=8-RC-Q7Wtzc
* Función borrar libros: https://stackoverflow.com/questions/19010177/javascript-get-form-array-values
* Función Inicio de sesión: https://stackoverflow.com/questions/247483/http-get-request-in-javascript
* Función para portada personalizada: https://www.w3schools.com/php/php_file_upload.asp

[cambiar_datos]: imagenes/cambiar_datos.png
[diagrama de páginas]: imagenes/diagrama_paginas.png
[inicio]: imagenes/index.png
[cabecera]: imagenes/cabecera.png
[catalogo]: imagenes/catalogo.png
[libro]: imagenes/libro.png
[capitulo]: imagenes/capitulo.png
[cap_botones]: imagenes/cap_botones.png
[inicio_sesion]: imagenes/inicio_sesion.png
[Nuevo_libro]: imagenes/Nuevo_libro.png
[ajustes_usuario]: imagenes/ajustes_usuario.png
[modificar_libro]: imagenes/modificar_libro.png
[modificar_capitulo]: imagenes/modificar_capitulo.png
[nuevo_capitulo]: imagenes/nuevo_capitulo.png
[modificar_libros]: imagenes/modificar_libros.png
[borrar_libros]: imagenes/borrar_libros.png 
