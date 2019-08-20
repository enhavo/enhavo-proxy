#!/usr/bin/env bash

if [ ! -f /etc/varnish/secret ]; then
    /var/www/current/bin/console proxy:varnish:create:secret
fi

echo "Install mysql"
/var/www/current/bin/console doctrine:database:create --if-not-exists
/var/www/current/bin/console doctrine:migration:migrate -n
