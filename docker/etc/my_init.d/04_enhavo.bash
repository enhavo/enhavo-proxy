#!/usr/bin/env bash
set -e

if [[ -f /var/www/app/cache/prod ]]; then
    rm /var/www/app/cache/prod
fi

#cd /var/www
#app/console doctrine:schema:update --force
#app/console fos:user:create admin info@localhost.com admin --super-admin