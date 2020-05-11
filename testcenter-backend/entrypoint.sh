#!/usr/bin/env bash

# db connection
rm /var/www/html/vo_code/DBConnectionData.json
echo "{\"type\": \"mysql\", \"host\": \"${MYSQL_HOST}\", \"port\": \"${MYSQL_PORT}\", \"dbname\": \"${MYSQL_DATABASE}\", \"user\": \"${MYSQL_USER}\", \"password\": \"${MYSQL_PASSWORD}\"}" > /var/www/html/config/DBConnectionData.json

# init data
php /var/www/html/scripts/initialize.php --user_name=$SUPERUSER_NAME --user_password=$SUPERUSER_PASSWORD --workspace=$WORKSPACE_NAME --test_login_name=$TEST_LOGIN_NAME --test_login_password=$TEST_LOGIN_PASSWORD

# composer dependencies
sh scripts/install_composer.sh
php composer.phar install

# file-rights
chown -R www-data:www-data /var/www/html/vo_data

# keep container open
apache2-foreground
