#!/usr/bin/env bash
set -e

if [[ -f /var/www/app/cache/prod ]]; then
    rm /var/www/app/cache/prod
fi

cd /var/www
mysql -u root -proot -h mysql -e 'CREATE DATABASE IF NOT EXISTS enhavo'
app/console doctrine:schema:update --force