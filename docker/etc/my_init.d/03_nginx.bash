#!/usr/bin/env bash
set -e
if [[ ! -f /etc/nginx/nginx.conf ]]; then
    echo "init nginx config"
	cp -ra /etc/nginx_default/* /etc/nginx
fi

chown root:www-data /etc/nginx/
chown root:www-data /etc/nginx/nginx.conf
chown -R root:www-data /var/ssl/
chmod 775 /etc/nginx/
chmod 775 /etc/nginx/nginx.conf
chmod -R 775 /var/ssl/
service nginx start