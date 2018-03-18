FROM "php:7.0-apache"

WORKDIR /usr/src/app

COPY . /usr/src/app

RUN apt-get update

# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

EXPOSE 8000
CMD php -S 0.0.0.0:8000
