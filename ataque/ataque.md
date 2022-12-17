## Vulnerabilidad explotada
Para realizar el ataque a la página UniFriends hemos optado por agregar un script en el apartado de actividades, dado que no hacen ninguna comprobación de si ese campo es un texto válido o no. El script introducido se ejecuta cada vez que alguien entra en ese apartado de la web. Una vez ejecutado, la contraseña del usuario es cambiada por otra totalmente diferente y se almacena en nuestra base de datos junto a su email

## Ejecutar el ataque
1. Desplegar ambos docker y entrar a localhost:81
2. Crear una cuenta
![registro]
2. Iniciar sesión
[Imagen 2]
3. Crear una actividad maliciosa
[Imagen 3]
4. Cualquier persona que haya iniciado sesión entra al catálogo de actividades
5. Mirar la base de datos para ver si alguien ha caido en la trampa
6. Entrar en su cuenta con los credenciales que aparecen en la base de datos
[registro]: imagenes/pprincipal.png

## Explicación del código
![Codigo1]
En estas líneas de código logramos obtener el nombre del usuario activo a través de la función asíncrona fetch() que recoge el cuerpo del texto de la url propocionada (http://localhost:81/editarMiPerfil.php).

![Codigo2]
En esta parte del código generamos una nueva contraseña para el usuario que está siendo atacado. Dicha contraseña la enviamos mediante un HTTP POST a su base de datos utilizando su página de cambiar contraseña. La contraseña la enviamos también a nuestra base de datos junto a su email
![FotoNuestraBD]