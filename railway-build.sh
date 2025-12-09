#!/bin/sh

# Composer
composer install --optimize-autoloader

# NPM
npm install
npm run build

# Laravel
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
