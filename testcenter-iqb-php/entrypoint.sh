#!/usr/bin/env bash
rm /var/www/html/vo_code/DBConnectionData.json
echo "{\"type\": \"mysql\", \"host\": \"${MYSQL_HOST}\", \"port\": \"${MYSQL_PORT}\", \"dbname\": \"${MYSQL_DATABASE}\", \"user\": \"${MYSQL_USER}\", \"password\": \"${MYSQL_PASSWORD}\"}" >> /var/www/html/vo_code/DBConnectionData.json
php /var/www/html/create/createSuperuser.cli.php --user_name=$SUPERUSER_NAME --user_password=$SUPERUSER_PASSWORD
apache2-foreground
