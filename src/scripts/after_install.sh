#!/bin/bash

set -eux

cd ~/laravel-ci/src
php artisan db:seed
php artisan migrate --force
php artisan config:cache