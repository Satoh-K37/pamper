#!/bin/bash

set -eux

cd ~/src
# php artisan db:seed
php artisan migrate --force
php artisan config:cache