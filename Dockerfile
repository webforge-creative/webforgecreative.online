# Use the official PHP image with Apache
FROM php:7.4-apache

# Enable the required PHP extensions for CodeIgniter 3
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable mod_rewrite for CodeIgniter 3
RUN a2enmod rewrite

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy your CodeIgniter 3 application files to the container
COPY . /var/www/html

# Set correct permissions for CodeIgniter's writable directory
RUN chown -R www-data:www-data /var/www/html/application/cache /var/www/html/application/logs
RUN chmod -R 777 /var/www/html/application/cache /var/www/html/application/logs

# Expose the default Apache port
EXPOSE 80

# Restart Apache server
CMD ["apache2-foreground"]
