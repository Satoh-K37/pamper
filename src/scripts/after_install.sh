#!/bin/bash

set -eux

cd ~laravel-ci
php artisan db:seed
php artisan migrate --force
php artisan config:cache