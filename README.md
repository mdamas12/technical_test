<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
PRUEBA TECNICA DE LARAVEL
</p>

## PASOS para ejecutar el proyecto 

para copiar el proyecto en su computador local debe realizar los siguienes pasos:

- clonar el proyecto : git clone https://github.com/mdamas12/technical_test.git
- moverse a la carpeta raiz del proyecto -> technical_test
- Ejecutar el comando npm install (para instalar todas la dependencias necesarias de inertia y el buen funcionamiento de Vuejs
- Crear la base de datos.


## Configuracion del archivo .env 

- La configuracion de la base de datos:
  
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=technical_test
    DB_USERNAME=root
    DB_PASSWORD=

- Variables de entorno para API STRIPE
  
  STRIPE_SK=sk_test_51Psn2pRtQRWcDdP5iV18N6keCdITVA69r8YfoyA8YXx4SDAfBJA2ntqCIGjaX993wfn6GrnCUSyRcIzUBbenUdUP00Soehquws
  STRIPE_PK=pk_test_51Psn2pRtQRWcDdP5AlD97t6P91OFh8UlfkNsBnkxpM29oMAQlNZlCdtRLLpHMaEze6tcw9ufqwCB7lOZcvIfJsrV00WRZe8ubp

## PHP ARTISAN 
una vez configurado el archivo .env debemos correr las migraciones del proyecto: 
- php artisan migrate
  
## Puesta en marcha del proyecto : 
 Para efecto de la prueba debemos tener dos servidores corriendo, uno para simular el servidor del cliente y otro para la api. dicho esto debera abrir dos consolas para mantener abierto ambos server.

 - En la primera consola ejecutar el comando: npm run dev
 - En la segunda consola ejecutar el comando: php artisan serve. el link generado por este comando podra copiarlo, abrirlo en el navegador de su preferencia y probar el proyecto. ejmplo: http://127.0.0.1:8000


## Modelos

- Tenemos un modelo usuarios usuario (login, register, logout)
- Tenemos un modelo order: donde se puede crear una order con cualquie monto, esta lista las ordenes del usuario logueado y se podra ejecutar el pago



## Pago con stripe

- Si el usuario ejecuta el pago, esta validara la informacion en orderscontroller->checkout y si todo esta bien consumira el api de Stripe y devolvera si el pago fue efectuado correctamente o no, 
- si el pago ha sido ejecutado correctamente se ejecuta una funcion (success) para actualizar el estado de la orden.


## Versiones 

- Laravel 11.21.0
- inertiajs 1.0.14
- Node 18.12.1
- npm 9.2.0
- vuejs 3

