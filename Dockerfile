FROM php:8.2-fpm
ARG user
ARG uid

# Combine apt update and install into a single RUN command to reduce layers
RUN apt update && apt install -y --no-install-recommends \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev && \
    apt clean && rm -rf /var/lib/apt/lists/*

# Ensure all necessary PHP extensions are installed
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Copy composer from the composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create a user with the specified UID and add to groups
RUN useradd -G www-data,root -u $uid -d /home/$user $user

# Create the user's composer directory and set permissions
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set the working directory
WORKDIR /var/www

# Switch to the created user
USER $user
