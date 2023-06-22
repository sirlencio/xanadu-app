REQUISITOS:
PHP, COMPOSER, NPM

BBDD:
tabla llamada xanadu

COMANDOS:
composer install
npm install
php artisan migrate --seed
npm run dev

SI NO CARGAN FOTOS DE PERFIL:
borrar carpeta storage dentro de la carpeta public
lanzar comando php artisan storage:link