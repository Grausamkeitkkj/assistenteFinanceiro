FROM php:8.2-apache

# Instala extensões comuns do PHP usadas com MySQL e PDO
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Ativa o mod_rewrite do Apache (essencial para reescrita de URLs amigáveis)
RUN a2enmod rewrite

# Define a pasta padrão de trabalho dentro do container
WORKDIR /var/www/html