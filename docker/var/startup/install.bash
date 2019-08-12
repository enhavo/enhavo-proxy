#!/usr/bin/env bash

echo "Install mysql"
/var/www/current/bin/console doctrine:database:create
/var/www/current/bin/console doctrine:migration:migrate -n
