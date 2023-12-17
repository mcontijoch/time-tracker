FROM php:8.2-fpm

WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && \
    apt-get install -y \
    git \
    curl \
    libsqlite3-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install mbstring exif pcntl bcmath gd pdo_sqlite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application files
COPY . .

# Install Composer dependencies
RUN composer install

# Generate Laravel application key
RUN php artisan key:generate

# Set permissions
RUN chmod -R 775 storage
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Clean cache
RUN php artisan cache:clear
RUN php artisan config:cache
RUN php artisan route:cache

# Migrate DB
RUN php artisan migrate

# Expose port 8000
EXPOSE 8000

# Start Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
