FROM "postgres:9.6.5"

WORKDIR /usr/src/app

COPY 1-config.sql /usr/src/app/
COPY 2-create.sql /usr/src/app/
COPY 3-triggers.sql /usr/src/app/
COPY 4-functions.sql /usr/src/app/
COPY 5-query.sql /usr/src/app/
COPY 6-insert.sql /usr/src/app/

ADD 1-config.sql /docker-entrypoint-initdb.d
ADD 2-create.sql /docker-entrypoint-initdb.d
ADD 3-triggers.sql /docker-entrypoint-initdb.d
ADD 4-functions.sql /docker-entrypoint-initdb.d
ADD 5-query.sql /docker-entrypoint-initdb.d
ADD 6-insert.sql /docker-entrypoint-initdb.d

EXPOSE 5432
