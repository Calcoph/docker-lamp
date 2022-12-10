# Fallos de seguridad de UNIFRIENDS

## Hay que poner los títulos de las secciones.
### Creación masiva de cuentas
El sistema web proporcionado no tiene un mecanismo que evite que un bot cree multicuentas de forma que el base de datos quede colapsada.

### Consultas parametrizadas
El sistema no realiza consultas preparadas, por lo que un atacante podría aprovechar este problema para extraer información. **Añadir páginas que realicen estas consultas**

### Contraseña de phpMyAdmin
La contraseña para acceder a la base de datos sigue siendo "test".

### Encryption at rest
Los datos que se encuentran en la base de datos no estan encriptados, asi que si un atacante lograse extraer información de ella no tendría ningún problema en leerla.

### No se guarda los logs
El sistema no guarda ningún tipo de información sobre los movimientos de un usuario, por lo que si se diese un ataque de fuerza bruta, no quedaría registrado en ningún sitio.

### Fallo al añadir actividades
No hay comprobaciones de que la fecha asignada a una actividad haya pasado. (No se si este tipo de fallos habrá que ponerlos).

## Preparar el entorno
Para ver cómo preparar el entorno, siga las instrucciones en el README.md de la rama `ataque` de nuestro proyecto (https://github.com/Calcoph/librerium/blob/ataque/README.md).

## Ejecutar el ataque
1. Crear una cuenta
2. Iniciar sesión
3. Crear una actividad maliciosa
4. Cualquier persona que haya iniciado sesión entra al catálogo de actividades
5. Mirar la base de datos para ver si alguien ha caido en la trampa
6. Entrar en su cuenta con los credenciales que aparecen en la base de datos
