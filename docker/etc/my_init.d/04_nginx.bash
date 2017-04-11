#!/usr/bin/env bash
set -e
if [[ ! -f /etc/nginx/nginx.conf ]]; then
	cp -ra /etc/nginx/nginx_default /etc/nginx
	/var/www/script/nginx_compile.bash
fi

service nginx restart