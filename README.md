# Librerium
Página web para publicar libros, reseñarlos y comentarlos.

## Instrucciones
1. Iniciar los contenedores: `sudo docker-compose up -d`
2. Asegurarse de que el contenedor `librerium_web_1` existe: `sudo docker ps -a`
3. En caso de no existir, cambiar el comando del paso 4 para que sea el contenedor que tenga `web` en alguna parte de su nombre
4. Dar permiso a php para escribir en una carpeta `sudo docker exec docker-lamp_web_1 chown www-data:www-data /home/www-data/uploads`
5. Abrir el navegador en `http://localhost:81/`
