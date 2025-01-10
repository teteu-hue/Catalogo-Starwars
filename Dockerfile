# Use uma imagem base com Apache e PHP
FROM php:8.2-apache

# Dependencies
RUN docker-php-ext-install pdo pdo_mysql

# Copiar info
COPY . /var/www/html

# Ajuste permissões para o diretório do Apache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Habilite o módulo de regravação (mod_rewrite) do Apache
RUN a2enmod rewrite

EXPOSE 80
