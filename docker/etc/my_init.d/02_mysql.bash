#!/usr/bin/env bash
set -e
if [[ ! -e /var/lib/mysql/mysql ]]; then
    echo "init mysql config"
	cp -ra /var/lib/mysql_default/* /var/lib/mysql/
fi
chown -R mysql:mysql /var/lib/mysql
service mysql start