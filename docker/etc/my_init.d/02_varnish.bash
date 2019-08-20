#!/usr/bin/env bash
set -e
if [[ ! -f /etc/varnish/default.vcl ]]; then
    echo "init varnish config"
    cp /var/startup/default.vcl /etc/varnish/default.vcl
fi

if [[ ! -f /etc/varnish/secret ]]; then
    echo "init varnish secret"
    /var/www/current/bin/console proxy:varnish:create:secret
fi

service varnish start