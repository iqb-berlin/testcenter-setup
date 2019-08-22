FROM php:7.3-apache-buster

LABEL maintainer="IQB Berlin"
LABEL version="1.0"
LABEL description="The PHP backend of the test center. This container ist for DEVELOPMENT only, not for deployment since security guidelines are somehow weak."
LABEL license="MIT"

# environment vars
ENV SUPERUSER_NAME=super
ENV SUPERUSER_PASSWORD=user456
ENV MYSQL_DATABASE=veranonline_testcenter
ENV MYSQL_USER=bla
ENV MYSQL_PASSWORD=bla
ENV MYSQL_PORT=3306
ENV MYSQL_HOST=127.0.0.1

# install php extensions
RUN docker-php-ext-install -j$(nproc) pdo_mysql

# set up apache
RUN a2enmod rewrite
RUN a2enmod headers
COPY config/vhost.conf /etc/apache2/sites-available
RUN ln -s /etc/apache2/sites-available /etc/apache2/sites-enabled
RUN unlink /etc/apache2/sites-enabled/000-default.conf

# copy source code
COPY src/ /var/www/html

# run install



# remove critaical files
#RUN rm -R /var/www/html/create
RUN rm -R /var/www/html/.git

# set file rights
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

COPY entrypoint.sh /root/entrypoint.sh
RUN chmod 777 /root/entrypoint.sh
ENTRYPOINT ["/root/entrypoint.sh"]
