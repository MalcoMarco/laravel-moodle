# En el Proyecto de MOODLE 
editar el archivo './lib/classes/session/manager.php'

```php
//linea 383
$sessionoptions = [
            'lifetime' => 0,
            'path' => $CFG->sessioncookiepath,
            //'domain' => $CFG->sessioncookiedomain, // SE AGREGO EL . PARA USARLO EN LOS SUBDOMINIOS
            'domain' => '.'.parse_url($CFG->wwwroot, PHP_URL_HOST),
            'secure' => $cookiesecure,
            'httponly' => $CFG->cookiehttponly,
        ];
```
se usara la misma sesion para los subdomios.
# Migraciones y seeders
```cmd
$ php artisan migrate:fresh --seed
```
