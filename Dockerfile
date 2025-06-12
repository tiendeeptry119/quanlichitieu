# Laravel Dockerfile for Render (sửa lỗi 403)
FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Cài các system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy source code vào
COPY . .

# Cài Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Set quyền
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# ⚠️ Sửa DocumentRoot thành thư mục public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Bật .htaccess
RUN echo '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

# Expose cổng mặc định
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
