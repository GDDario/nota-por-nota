FROM php:8.4.2-fpm

WORKDIR /var/www/html

RUN apt-get update -y \
    && apt-get install -y --no-install-recommends \
        libzip-dev \
        curl \
        libxml2-dev \
        wget \
        vim \
        libonig-dev \
        libpq-dev \
    && docker-php-ext-configure mbstring \
    && docker-php-ext-install \
        zip \
        mbstring \
        pdo \
        pdo_pgsql \
        opcache \
        pcntl \
        xml \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Configure PHP-FPM to listen on port 8000
RUN { \
    echo "[global]"; \
    echo "error_log = /proc/self/fd/2"; \
    echo "[www]"; \
    echo "listen = 0.0.0.0:8000"; \
    echo "pm = dynamic"; \
    echo "pm.max_children = 5"; \
    echo "pm.start_servers = 2"; \
    echo "pm.min_spare_servers = 1"; \
    echo "pm.max_spare_servers = 3"; \
    echo "catch_workers_output = yes"; \
    echo "; Removed 'listen.allowed_clients' to allow connections from all clients"; \
} > /usr/local/etc/php-fpm.d/zz-docker.conf

RUN chown -R www-data:www-data /var/www/html

COPY php.ini /usr/local/etc/php/php.ini

EXPOSE 8000

CMD ["php-fpm", "-F"]