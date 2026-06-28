#!/bin/sh
set -e

# Garante que o banco SQLite existe no volume persistente
if [ ! -f /var/www/html/storage/database.sqlite ]; then
    touch /var/www/html/storage/database.sqlite
fi

chown -R www-data:www-data /var/www/html/storage
chmod -R 755 /var/www/html/storage

# Executa migrações
php /var/www/html/artisan migrate --force

# Cache de configurações para produção
php /var/www/html/artisan config:cache
php /var/www/html/artisan route:cache
php /var/www/html/artisan view:cache

exec supervisord -c /etc/supervisor/conf.d/supervisord.conf
