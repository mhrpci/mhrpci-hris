# Base image: PHP 8.2 FPM
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer from the official Composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www

# Copy the application code into the container
COPY . /var/www

# Install Composer dependencies (with optimization flags for production)
RUN composer install --optimize-autoloader --no-dev --no-interaction --no-plugins --no-scripts

# Set correct file permissions
RUN chown -R www-data:www-data /var/www

# Expose port 9000 (used by php-fpm)
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
