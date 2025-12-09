#!/bin/sh
set -x 
# Composer
composer install --optimize-autoloader --verbose

# NPM
npm install --verbose
npm run build --verbose

# Laravel
php artisan migrate --force --verbose
php artisan db:seed --force --verbose
php artisan storage:link
