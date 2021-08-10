#!/usr/bin/env sh

set -xeu

echo Waiting for database
until nc -z "${WORDPRESS_DB_HOST}:3306"; do echo "Retrying..."; sleep 1; done
echo Connected to database

wp config create --dbname=${WORDPRESS_DB_NAME} --dbhost=${WORDPRESS_DB_HOST} --dbuser=${WORDPRESS_DB_USER} --dbpass=${WORDPRESS_DB_PASSWORD}
wp core install --url="${WORDPRESS_URL}" --title=IPCC --admin_user=admin --admin_password=admin --admin_email=email@email.com --skip-email
wp theme activate ipcasacaiada
exec php -S 0.0.0.0:8000
