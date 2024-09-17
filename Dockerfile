# Use the official PHP image with Apache
FROM php:7.4-apache

# Install dependencies and enable required PHP extensions
RUN apt-get update && \
    apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli pdo pdo_mysql \
    && a2enmod rewrite \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy only the dependency files first to leverage Docker caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --prefer-dist

# Copy the rest of the application files
COPY . /var/www/html

# Set correct permissions for CodeIgniter's writable directory
RUN chown -R www-data:www-data /var/www/html/application/cache /var/www/html/application/logs \
    && chmod -R 777 /var/www/html/application/cache /var/www/html/application/logs

# Expose the default Apache port
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
