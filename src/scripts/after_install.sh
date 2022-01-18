#!/bin/bash

set -eux

cd ~/srcs
php artisan migrate --force
php artisan config:cache