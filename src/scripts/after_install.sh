#!/bin/bash

set -eux

cd ~/spoily-ci
php artisan migrate --force
php artisan config:cache