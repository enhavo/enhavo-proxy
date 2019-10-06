![alt text](assets/enhavo/images/enhavo.svg "enhavo")
<br/>
<br/>

Enhavo Proxy
------------

The goal of enhavo proxy is to create a proxy with focus on load balancing and caching issue, which is easily to configure
over cli and a web interface. It supports SSL with own and Let's Encrypt certificates.

Enhavo proxy is made for docker, so it's easy to install on docker hosts.

Please don't use it for production unless we release version 1.0. We can't guarantee backward compatibility and we may
have still miss configuration.

Architecture
------------

We use varnish as proxy server. Varnish can't handle ssl request by default, so we use nginx to resolve https request.
We use apache only for the web interface, which is based on [enhavo](https://github.com/enhavo/enhavo).
The configuration is stored to a mysql database. If you apply the configuration they will be written to the filesystem and overwrite the configuration
files.

![alt text](assets/enhavo/images/architecture.svg "enhavo-proxy")


Run Docker
----------

```bash
$ docker run -d -e DATABASE_URL='mysql://root:root@mysql:3306/enhavo-proxy' --link 'mysql:mysql' -p '80:80' -p '443:443' -p '8080:8080'  enhavo/enhavo-proxy
```

Or copy this `docker-compose.yml` file to your file system and run `docker-compose up -d`  

```yaml
version: '3'
services:
  proxy:
    container_name: enhavo-proxy
    image: enhavo/enhavo-proxy
    ports:
      - "80:80"
      - "443:443"
      - "8080:8080"
    volumes:
      - '/data/enhavo-proxy/nginx:/etc/nginx'
      - '/data/enhavo-proxy/varnish:/etc/varnish'
      - '/data/enhavo-proxy/ssl:/var/ssl'
    environment:
      DATABASE_URL: mysql://root:root@mysql:3306/enhavo-proxy
  mysql:
    container_name: mysql
    image: mariadb:10.3
    environment:
      MYSQL_ROOT_PASSWORD: root
    volumes:
      - '/data/enhavo-proxy/mysql:/var/lib/mysql'
```

Contribution
------------

Feel free to contribute

MIT License
-----------

This software is free to use with MIT License