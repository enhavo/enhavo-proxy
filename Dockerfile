FROM phusion/baseimage

CMD ["/sbin/my_init"]

# install server tools
RUN add-apt-repository -y ppa:ondrej/php && \
    export DEBIAN_FRONTEND=noninteractive && \
    echo 'mysql-apt-config mysql-apt-config/repo-codename select trusty' | debconf-set-selections && \
    echo 'mysql-apt-config mysql-apt-config/repo-distro select ubuntu' | debconf-set-selections && \
    echo 'mysql-apt-config mysql-apt-config/repo-url string http://repo.mysql.com/apt/' | debconf-set-selections && \
    echo 'mysql-apt-config mysql-apt-config/select-preview select' | debconf-set-selections && \
    echo 'mysql-apt-config mysql-apt-config/select-product select Ok' | debconf-set-selections && \
    echo 'mysql-apt-config mysql-apt-config/select-server select mysql-5.7' | debconf-set-selections && \
    echo 'mysql-apt-config mysql-apt-config/select-tools select' | debconf-set-selections && \
    echo 'mysql-server mysql-server/root_password password root' | debconf-set-selections && \
    echo 'mysql-server mysql-server/root_password_again password root' | debconf-set-selections && \
    apt-get update -y --force-yes && \
    apt-get upgrade -y --force-yes && \
    apt-get install -y --force-yes apache2 && \
    apt-get install -y --force-yes varnish && \
    apt-get install -y --force-yes nginx && \
    apt-get install -y --force-yes php7.0 && \
    apt-get install -y --force-yes php7.0-gd && \
    apt-get install -y --force-yes php7.0-curl && \
    apt-get install -y --force-yes php7.0-mbstring && \
    apt-get install -y --force-yes php7.0-dom && \
    apt-get install -y --force-yes php7.0-intl && \
    apt-get install -y --force-yes php7.0-mysql && \
    apt-get install -y --force-yes git && \
    apt-get install -y --force-yes sudo && \
    a2enmod rewrite && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    apt-get install -y --force-yes mysql-server

#apache
COPY docker/etc/apache2/ports.conf /etc/apache2/ports.conf
COPY docker/etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/000-default.conf

#nginx
COPY docker/etc/sudo/sudoers /etc/sudoers
RUN cp -ra /etc/nginx /etc/nginx_default && \
    chmod 440 /etc/sudoers

# server setting and start up scripts
COPY docker/etc/my_init.d/01_apache2.bash /etc/my_init.d/01_apache2.bash
COPY docker/etc/my_init.d/02_mysql.bash /etc/my_init.d/02_mysql.bash
COPY docker/etc/my_init.d/03_varnish.bash /etc/my_init.d/03_varnish.bash
COPY docker/etc/my_init.d/04_nginx.bash /etc/my_init.d/04_nginx.bash
RUN chmod 755 /etc/my_init.d/01_apache2.bash && \
    chmod 755 /etc/my_init.d/02_mysql.bash && \
    chmod 755 /etc/my_init.d/03_varnish.bash && \
    chmod 755 /etc/my_init.d/04_nginx.bash

## add source files
ADD app /var/www/app
ADD src /var/www/src
ADD web /var/www/web
ADD scripts /var/www/scripts
ADD composer.json /var/www/composer.json
ADD composer.lock /var/www/composer.lock

# install enhavo
RUN mkdir -p /var/run/mysqld && \
    chown mysql:mysql /var/run/mysqld && \
    /bin/bash -c "/usr/bin/mysqld_safe &" && \
    sleep 5 && \
    mysql -u root -proot -e "CREATE DATABASE enhavo" && \
    cd /var/www/ && \
    composer install --no-interaction && \
    app/console doctrine:schema:update --force && \
    app/console fos:user:create admin info@localhost.com admin --super-admin && \
    cp -ra /var/lib/mysql /var/lib/mysql_default

# install varnish
COPY docker/etc/default/varnish /etc/default/varnish

# user rights
RUN usermod -u 1000 www-data && \
    cd /var/www/ && \
    chown www-data:www-data -R app/cache && \
    chmod 755 app/cache && \
    chown www-data:www-data -R app/logs && \
    chmod 755 app/logs && \
    chown www-data:www-data -R app/media && \
    chmod 755 app/media

WORKDIR /var/www

VOLUME ["/etc/nginx", "/etc/varnish", "/var/lib/mysql", "/var/www/app/media"]

EXPOSE 8080
EXPOSE 80
EXPOSE 443