FROM php:7.4-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

COPY setup.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/setup.sh 

CMD ["/usr/local/bin/setup.sh"]



