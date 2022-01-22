#!/bin/bash

set -eux

cd ~/spoily-ci/src
php artisan db:seed
php artisan migrate:fresh --force
php artisan config:cache