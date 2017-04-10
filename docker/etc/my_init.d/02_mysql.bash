#!/usr/bin/env bash
set -e
if [[ ! -e /var/lib/mysql/mysql ]]; then
	cp -ra /var/lib/mysql_default/* /var/lib/mysql/
fi
service mysql start