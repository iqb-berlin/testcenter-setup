FROM php:7.2.2-apache

LABEL maintainer="IQB Berlin"
LABEL version="1.0"
LABEL description="The PHP backend of the test center. This container ist for DEVELOPMENT only, not for deployment since security guidelines are somehow weak."
LABEL license="MIT"

# set up apache
RUN a2enmod rewrite
RUN a2enmod headers
COPY config/vhost.conf /etc/apache2/sites-available
RUN ln -s /etc/apache2/sites-available /etc/apache2/sites-enabled
RUN unlink /etc/apache2/sites-enabled/000-default.conf

# copy source code
COPY src/ /var/www/html

# run install


# remove critacal files
RUN rm -R /var/www/html/create
RUN rm -R /var/www/html/.git

# set file rights
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
