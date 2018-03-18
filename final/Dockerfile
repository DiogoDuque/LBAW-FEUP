FROM "php:7.0-cli"

WORKDIR /usr/src/app

COPY . /usr/src/app

ADD php.ini /usr/local/etc/php

EXPOSE 8000
CMD php -c php.ini index.php
