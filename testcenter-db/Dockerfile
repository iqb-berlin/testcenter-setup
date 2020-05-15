FROM mysql:5.7

LABEL maintainer="IQB Berlin"
LABEL version="1.0"
LABEL description="MySQL Container for text center backend"
LABEL license="MIT"

ENV MYSQL_DATABASE=iqb_tba_textcenter_1
ENV MYSQL_USER=iqb_tba_db_user_1
ENV MYSQL_PASSWORD=iqb_tba_db_password_1
ENV MYSQL_ROOT_PASSWORD=secret_root_pw_1
ENV MYSQL_INITDB_SKIP_TZINFO=true

# config
COPY config/my.cnf /etc/mysql/conf.d/my.cnf

# import database and createsuperuser script
#COPY src/db.mysql.sql /docker-entrypoint-initdb.d/1-db.mysql.sql
