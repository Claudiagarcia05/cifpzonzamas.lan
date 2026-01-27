#!/bin/bash
echo "🔄 Reiniciando base de datos..."
/c/xampp/mysql/bin/mysql.exe -u root -e "DROP DATABASE IF EXISTS zonzamas"
/c/xampp/mysql/bin/mysql.exe -u root -e "CREATE DATABASE zonzamas CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
sed -i 's/SESSION_DRIVER=database/SESSION_DRIVER=file/' .env
/c/xampp/php/php.exe artisan config:clear
/c/xampp/php/php.exe artisan migrate
echo "✅ Base de datos recreada y migraciones ejecutadas"
