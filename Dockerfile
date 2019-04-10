FROM phusion/baseimage:0.9.22

# install server tools
RUN apt-get update -y && \
    apt-get upgrade -y && \
    apt-get install -y apache2 && \
    apt-get install -y varnish && \
    apt-get install -y nginx && \
    apt-get install -y sudo && \
    apt-get install -y php7.0 && \
    apt-get install -y php7.0-gd && \
    apt-get install -y php7.0-curl && \
    apt-get install -y php7.0-mbstring && \
    apt-get install -y php7.0-dom && \
    apt-get install -y php7.0-intl && \
    apt-get install -y php7.0-mysql && \
    apt-get install -y php7.0-zip && \
    apt-get install -y libapache2-mod-php7.0 && \
    apt-get install -y mysql-client && \
    apt-get install -y composer

# server setting and start up scripts
COPY docker/etc/my_init.d/01_apache2.bash /etc/my_init.d/01_apache2.bash
COPY docker/etc/my_init.d/02_varnish.bash /etc/my_init.d/02_varnish.bash
COPY docker/etc/my_init.d/03_nginx.bash /etc/my_init.d/03_nginx.bash
COPY docker/etc/my_init.d/04_enhavo.bash /etc/my_init.d/04_enhavo.bash
RUN chmod 755 /etc/my_init.d/01_apache2.bash && \
    chmod 755 /etc/my_init.d/02_varnish.bash && \
    chmod 755 /etc/my_init.d/03_nginx.bash && \
    chmod 755 /etc/my_init.d/04_enhavo.bash && \
    a2enmod rewrite

# apache config
COPY docker/etc/apache2/ports.conf /etc/apache2/ports.conf
COPY docker/etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/000-default.conf

# nginx config
COPY docker/etc/sudo/sudoers /etc/sudoers
RUN rm -f /etc/nginx/sites-available/default && \
    rm -f /etc/nginx/sites-enabled/default && \
    cp -ra /etc/nginx /etc/nginx_default && \
    chmod 440 /etc/sudoers

# varnish
COPY docker/etc/default/varnish /etc/default/varnish

#logrotate
COPY docker/etc/logrotate.d/apache /etc/logrotate.d/apache
COPY docker/etc/logrotate.d/nginx /etc/logrotate.d/nginx

# enhavo
COPY app /var/www/app
COPY src /var/www/src
COPY scripts /var/www/scripts
COPY web /var/www/web
COPY composer.json /var/www/composer.json
COPY composer.lock /var/www/composer.lock

WORKDIR /var/www

COPY docker/var/www/app/config/parameters.yml /var/www/app/config/parameters.yml
RUN chown -R www-data:www-data /var/www/*  && \
    composer install --no-scripts --no-dev --no-interaction

VOLUME ["/etc/nginx", "/etc/varnish", "/var/www"]

EXPOSE 8080
EXPOSE 80
EXPOSE 443

