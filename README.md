
## Instrucciones de instalacion

- Una vez que se baja el repositorio se debe hacer un composer install
- Configurar la base de datos. Correr las migraciones.
- En el .env se debe setear la siguiente variable:
  L5_SWAGGER_CONST_HOST=http://localhost:8000/api

- Se debe correr el siguiente comando: php artisan l5-swagger:generate
- Luego php artisan serve
- Abrir la url http://localhost:8000/api/documentation y ya veremos la API

## Imagen de la API

<img src="https://i.ibb.co/frGVj9W/Capture.png" alt="Capture" border="0">