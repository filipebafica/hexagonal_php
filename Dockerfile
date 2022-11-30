FROM php:8.1-fpm

RUN apt-get update && apt-get install -y bash sudo unzip zip git curl libpng-dev libonig-dev libxml2-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /home/$user

USER $user
