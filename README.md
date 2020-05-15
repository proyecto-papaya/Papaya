# Descargar y ejecutar el proyecto

Antes que nada, la máquina en la que clonemos el proyecto tendrá que tener instalado Laravel.

Para poder ejecutar papaya, primero habrá que clonar el proyecto en local con `git clone <url_papaya>`.

Una vez clonado, desde la carpeta del proyecto, tendremos que instalar las dependencias:

* `composer require laravel/ui --dev`
* `composer install`
* `cp .env.example .env`
* `php artisan key:generate`
* `php artisan storage:link`

Para que funcione bien el sistema de login tenemos que cambiar la L153 de `vendor/ui/auth-backend/AuthenticateUsers`
y poner `return name;`.

Para lanzarlo al navegador con artisan:

`php artisan serve`
