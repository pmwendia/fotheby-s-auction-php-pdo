FROM  mysql:5.7
COPY ./ass_database.sql /docker-entrypoint-initdb.d/
