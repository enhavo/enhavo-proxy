#!/usr/bin/env bash
set -e
if [[ ! -f /etc/varnish/default.vcl ]]; then
	/var/www/app/console varnish:compile
	/var/www/app/console varnish:create:secret
fi