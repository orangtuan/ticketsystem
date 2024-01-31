# Base Image PHP
FROM php:8.3-apache

# Extensions fuer Mysql Verbindungen (also mysqli und PDO)
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo pdo_mysql

# Rewrite-Modul von Apache, falls du mit .htaccess arbeiten willst
RUN a2enmod rewrite