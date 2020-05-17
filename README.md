# Papaya - WIP :test_tube:

Papaya es el proyecto final de DAW de [anmacovei](https://github.com/anmacovei), [juancarlosfcxp](https://github.com/juancarlosfcxp) y [mperezv](https://github.com/mperezv/).

<img src="https://github.com/proyecto-papaya/Papaya/blob/master/public/logo.svg" alt="drawing" width="200"/>

El objetivo es que sea una aplicación web para compartir archivos de distintos tipos en forma de post, y que el resto de usuarias puedan descargarlos en sus máquinas o verlos/escucharlos en la plataforma.

Actualmente, no tenemos un sistema de containers que permita configurar el entorno de desarrollo de una manera sencilla porque no hemos tenido el tiempo para montarlo. Por eso las instrucciones para descargar y ejecutar el proyecto pueden ser un poco estrafalarias, o largas. Esperamos mejorar esta parte en un futuro y así facilitar las contribuiciones externas a nuestro proyecto.


# Descargar y ejecutar el proyecto :pick: :wrench: :nerd_face:

Antes que nada, la máquina en la que clonemos el proyecto tendrá que tener instalado Laravel.

Para poder ejecutar papaya, primero habrá que clonar el proyecto en local con `git clone <url_papaya>`.

Una vez clonado, desde la carpeta del proyecto, tendremos que instalar las dependencias:

* `composer require laravel/ui --dev`
* `composer install`
* `php artisan key:generate`
* `php artisan storage:link`

## Base de datos

Para configurar la base de datos copiar el `.env.example` con `cp .env.example .env`, tendremos que setear las siguientes variables de entorno:

* `DB_CONNECTION` -> tipo de base de datos, nosotras utilizamos mysql
* `DB_HOST`-> endpoint de nuestra base de datos
* `DB_PORT`-> puerto de nuestra base de datos. En mysql, 3306.
* `DB_DATABASE`-> nombre de nuestra base de datos
* `DB_USERNAME` -> nombre de usuaria con el que nos conectaremos a la base de datos
* `DB_PASSWORD` -> contraseña de la base de datos

También es importante recordar la variable `APP_DEBUG` que en desarrollo tendrá que estar seteada a `true` pero en producción siempre en `false`. Si no lo hiciéramos así, nos arriesgamos a exponer información sensible y esto hace nuestra aplicación menos segura.

## Ver la página desde el navegador

Para lanzarlo al navegador con artisan:

`php artisan serve`
