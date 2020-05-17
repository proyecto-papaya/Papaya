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
* `cp .env.example .env` y configurar con la base de datos que se quiera
* `php artisan key:generate`
* `php artisan storage:link`

## Sobreescribiendo el auth de Laravel

Todavía no hemos podido sobreescribir los métodos del paquete Auth de Laravel, así que los cambios se tendrán que introducir manualmente ya que se hacen en `Vendor` y, como es habitual, está añadida en el `.gitignore`.

Para que funcione bien el sistema de login tenemos que cambiar la L153 de `vendor/ui/auth-backend/AuthenticateUsers`
y poner `return name;`.

Hay que ir al archivo:
`
vendor/laravel/framework/src/Illuminate/Auth/Events/Registered.php` 
y editar la funcion` __construct` de esta forma:

```php
public function __construct($user)
{
$this->user = $user;
$this->user->profile_picture="images/user.png";
$this->user->save();
}
```

## Ver la página desde el navegador

Para lanzarlo al navegador con artisan:

`php artisan serve`
