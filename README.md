# Librerium
Página web para publicar libros, reseñarlos y comentarlos.

Hecho por: Francisco González, Diego Esteban, Ibai Mendivil.

## Preparar el entorno
1. Preparar la página web atacada
    1. Clonar el repositorio
        * `https://github.com/julenh/SGSSI22.git`
    2. Cambiarse a la rama "Entrega_1"
        * `git checkout -b ataque origin/ataque`
    3. `cd SGSSI22`
    4. Crear la imagen **web**:
        * `$ docker build -t="web" .`
    5. Iniciar los contenedores:
        * `$ docker-compose up -d`
    6. Abrir el navegador en **http://localhost:8890/**
    7. Iniciar sesión con usuario: **admin**, contraseña: **test**
    8. Importar la base de datos **database.sql** (Ver abajo para tutorial con imágenes)
2. Preparar nuestro proyecto (en la rama ataque)
    1. clonar el repositorio
        * `git clone https://github.com/Calcoph/librerium.git`
    2. Cambiarse a la rama "ataque"
        * `git checkout -b ataque origin/ataque`
    3. `cd librerium`
    4. Crear la imagen **web**:
        * `$ docker build -t="web" .`
    5. Iniciar los contenedores:
        * `$ docker-compose up -d`
    6. Abrir el navegador en **http://localhost:8891/**
    7. Iniciar sesión con usuario: **admin**, contraseña: **5%56#ALXvsWeDHrxW#H@gGpZEmGBb#jcjYRrLfSHnQ5jUGRCRB&8rU7EHZvX%LEXDFB!QjH#sz43T\*J93cCta^Jvx\*PLzjSvKo57D#us@69Twd^sCzaw4eeGSmAULefs**
    8. Importar la base de datos **database.sql**:
        1. Seleccionar la base de datos **database** ![](/resources/elegir_database.png)
        2. Cambiar a la pestaña **import** ![](/resources/import.png)
        3. Pinchar en **browse** y elegir **database.sql** ![](/resources/browse.png)
        4. Scrollear al final de la página y pinchar en **import** ![](/resources/
