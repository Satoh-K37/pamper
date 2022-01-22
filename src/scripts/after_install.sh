#!/bin/bash

set -eux

cd ~/spoily-ci/src
php artisan db:seed
php artisan migrate --force
php artisan config:cache