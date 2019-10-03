#!/usr/bin/env bash
set -e
if [[ ! -f /etc/nginx/nginx.conf ]]; then
    echo "init nginx config"
	cp -ra /etc/nginx_default/* /etc/nginx
fi

chown root:www-data /etc/nginx/
chown root:www-data /etc/nginx/nginx.conf
chmod 775 /etc/nginx/
chmod 775 /etc/nginx/nginx.conf
service nginx start