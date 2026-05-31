#!/bin/bash
export DB_CONNECTION=pgsql
export DB_HOST=dpg-d8djv8navr4c73frmhug-a
export DB_PORT=5432
export DB_DATABASE=recipes_db_4k50
export DB_USERNAME=recipes_db_4k50_user
export DB_PASSWORD=tL1uyJI6Mz4NTE2EPvtnRD9ZSGyxyLiu
export APP_URL=https://recipes1-4es9.onrender.com
export SESSION_SECURE_COOKIE=false
php artisan config:clear
php artisan migrate --force
PGPASSWORD=tL1uyJI6Mz4NTE2EPvtnRD9ZSGyxyLiu psql -h dpg-d8djv8navr4c73frmhug-a -U recipes_db_4k50_user -d recipes_db_4k50 -c 'DELETE FROM recipes;'
php artisan import:recipes
apache2-foreground
