docker
- docker system prune
- docker run -d -p 8000:80 --name webserver nginx

phpunit
- php bin/console server:start
- php ./vendor/bin/simple-phpunit