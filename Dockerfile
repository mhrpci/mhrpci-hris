# Base image: PHP 8.2 FPM
FROM php:8.2-fpm

# Set environment variables
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_HOME=/composer

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

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www

# Copy composer files and install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader --no-dev

# Copy the rest of the application code
COPY . .

# Generate optimized autoloader and run any necessary scripts
RUN composer dump-autoload --optimize --no-dev --classmap-authoritative \
    && composer run-script post-install-cmd --no-dev

# Set correct file permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage /var/www/bootstrap/cache

# Create a non-root user to run the app
RUN adduser --disabled-password --gecos '' appuser

# Switch to non-root user
USER appuser

# Expose port 9000 (used by php-fpm)
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
