SHELL := /bin/bash

clean:
	docker rmi enhavo/proxy:latest

build:
	docker build --no-cache -t enhavo/proxy:latest .

run:
	docker run -d -it --rm -p 80:80 -p 443:443 -p 8080:8080 --name enhavo-proxy enhavo/proxy:latest

push:
	docker push enhavo/proxy:master