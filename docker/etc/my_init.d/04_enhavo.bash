#!/usr/bin/env bash
set -e

if [[ -f /var/www/current/cache/prod ]]; then
    rm /var/www/current/var/cache/prod
fi

cd /var/www/current
echo "Startup"
/var/startup/wait-for-it/wait-for-it.sh -h mysql -p 3306 -- bash /var/startup/install.bash