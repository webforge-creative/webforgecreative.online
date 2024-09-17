# Use the official PHP image with Apache
FROM php:7.4-apache

# Enable the required PHP extensions for CodeIgniter 3
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable mod_rewrite for CodeIgniter 3
RUN a2enmod rewrite

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the CodeIgniter application files
COPY . /var/www/html/

# Set correct permissions for CodeIgniter's writable directories
RUN chown -R www-data:www-data /var/www/html/application/cache /var/www/html/application/logs && \
    chmod -R 777 /var/www/html/application/cache /var/www/html/application/logs

# Configure Apache to handle clean URLs
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Expose the default Apache port
EXPOSE 80

# Restart Apache server
CMD ["apache2-foreground"]