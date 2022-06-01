#!/bin/bash

sleep 5s

su -c "composer install" -s /bin/sh nginx
su -c "php artisan migrate --seed" -s /bin/sh nginx
php-fpm

exit 0
