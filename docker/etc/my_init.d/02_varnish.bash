#!/usr/bin/env bash
set -e

if [[ ! -f /etc/varnish/default.vcl ]]; then
    echo "init varnish config"
    cp /var/startup/default.vcl /etc/varnish/default.vcl
fi

touch /etc/varnish/default.vcl
chown root:www-data /etc/varnish/
chown root:www-data /etc/varnish/default.vcl
chmod 775 /etc/varnish/
chmod 775 /etc/varnish/default.vcl

if [[ ! -f /etc/varnish/secret ]]; then
    echo "init varnish secret"
    /var/www/current/bin/console proxy:varnish:create:secret
fi

service varnish start