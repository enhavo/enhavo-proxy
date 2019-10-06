FROM phusion/baseimage:0.11

# install server tools
RUN apt-get update -y && \
    apt-get upgrade -y  && \
    ln -fs /usr/share/zoneinfo/Europe/Berlin /etc/localtime  && \
    apt-get install -y apache2 && \
    a2enmod proxy_fcgi && \
    apt-get install -y varnish && \
    apt-get install -y nginx && \
    apt-get install -y sudo && \
    apt-get install -y logrotate && \
    curl -sL https://deb.nodesource.com/setup_10.x | sudo -E bash - && \
    apt-get install -y nodejs && \
    curl -o- -L https://yarnpkg.com/install.sh | bash && \
    mkdir /var/startup && \
    apt-get install -y git && \
    git clone https://github.com/vishnubob/wait-for-it.git /var/startup/wait-for-it && \
    apt-get install -y php7.2-fpm && \
    apt-get install -y php7.2-gd && \
    apt-get install -y php7.2-curl && \
    apt-get install -y php7.2-mbstring && \
    apt-get install -y php7.2-dom && \
    apt-get install -y php7.2-intl && \
    apt-get install -y php7.2-mysql && \
    apt-get install -y php7.2-zip && \
    apt-get install -y mysql-client && \
    apt-get install -y composer && \
    rm -rf /var/www/html && \
    cp /etc/varnish/default.vcl /var/startup/default.vcl  && \
    git clone https://github.com/enhavo/enhavo-proxy.git /var/www/current

# server setting and start up scripts
COPY etc/my_init.d/01_apache2.bash /etc/my_init.d/01_apache2.bash
COPY etc/my_init.d/02_varnish.bash /etc/my_init.d/02_varnish.bash
COPY etc/my_init.d/03_nginx.bash /etc/my_init.d/03_nginx.bash
COPY etc/my_init.d/04_enhavo.bash /etc/my_init.d/04_enhavo.bash
COPY etc/my_init.d/05_php-fpm.bash /etc/my_init.d/05_php-fpm.bash

# apache config
COPY etc/apache2/ports.conf /etc/apache2/ports.conf
COPY etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/000-default.conf

# php config
COPY etc/php/7.2/fpm/pool.d/www.conf /etc/php/7.2/fpm/pool.d/www.conf

# nginx config
COPY etc/sudo/sudoers /etc/sudoers

# varnish
COPY etc/default/varnish /etc/default/varnish

# logrotate
COPY etc/logrotate.d/apache2 /etc/logrotate.d/apache2
COPY etc/logrotate.d/nginx /etc/logrotate.d/nginx

# enhavo
COPY var/startup/install.bash /var/startup/install.bash

# cronjob
COPY cron/crontab /var/spool/cron/crontabs/root

WORKDIR /var/www/current

RUN rm -f /etc/nginx/sites-available/default && \
    rm -f /etc/nginx/sites-enabled/default && \
    cp -ra /etc/nginx /etc/nginx_default && \
    chmod 440 /etc/sudoers && \
    chmod 755 /etc/my_init.d/01_apache2.bash && \
    chmod 755 /etc/my_init.d/02_varnish.bash && \
    chmod 755 /etc/my_init.d/03_nginx.bash && \
    chmod 755 /etc/my_init.d/04_enhavo.bash && \
    chmod 755 /etc/my_init.d/05_php-fpm.bash && \
    a2enmod rewrite && \
    composer install --no-scripts --no-dev --no-interaction && \
    bin/console fos:js-routing:dump --format=json --target=public/js/fos_js_routes.json && \
    bin/console cache:warmup && \
    chown -R www-data:www-data /var/www/current/var && \
    /root/.yarn/bin/yarn install && \
    /root/.yarn/bin/yarn encore prod && \
    chmod 0644 /var/spool/cron/crontabs/root && \
    crontab -u root /var/spool/cron/crontabs/root

ENV COMPOSER_HOME=/root/.composer/

VOLUME ["/etc/nginx", "/etc/varnish", "/var/www", "/var/ssl"]

EXPOSE 8080
EXPOSE 80
EXPOSE 443
EXPOSE 22
