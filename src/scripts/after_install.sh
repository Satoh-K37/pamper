#!/bin/bash

set -eux

cd ~/spoily-ci
php artisan db:seed
php artisan migrate --force
php artisan config:cache