para cambiar la contraseña, hay que seguir los siguientes pasos:
1. `$ docker-compose down`
2. introducir la nueva contraseña en el fichero db_pass.txt
3. ejecutar el script update_password.py
4. eliminar la carpeta mysql
5. rebuildear el la imagen "web" `$ docker build -t="web" .`
6. `$ docker-compose up -d`