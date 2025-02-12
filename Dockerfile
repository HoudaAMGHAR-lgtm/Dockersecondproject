# Utiliser PHP 8.2 avec Apache
FROM php:8.2-apache

# Copier le code source dans le dossier de l'hôte Apache
COPY src/ /var/www/html/

# Installer des extensions PHP (si besoin, ici ex. pour MySQL)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Ouvrir le port 80
EXPOSE 80
