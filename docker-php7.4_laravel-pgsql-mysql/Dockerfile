FROM php:7.4-fpm

# Copy composer.lock and composer.json
#COPY composer.lock composer.json /var/www/

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    libzip-dev \
    jpegoptim optipng pngquant gifsicle \
    nano \
    unzip \
    git \
    libpq-dev \
    libonig-dev \
    libsqlite3-dev \
    sqlite \
    wget \
    sudo \
    curl \
    postgresql-client-common \
    postgresql-client \
    net-tools \
    iputils-ping \
    procps

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_mysql pdo_sqlite mbstring zip exif pcntl
#RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd
RUN pecl install xdebug-2.9.6
RUN pecl install mongodb-1.5.0
RUN docker-php-ext-enable xdebug

# Install Redis
RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

# Install composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl https://getcomposer.org/download/2.0.8/composer.phar --output /usr/local/bin/composer && \
 chmod +x /usr/local/bin/composer

RUN cp /usr/local/bin/composer /usr/local/bin/composer2

RUN curl https://getcomposer.org/download/1.7.3/composer.phar --output /usr/local/bin/composer1 && \
 chmod +x /usr/local/bin/composer1

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www
RUN echo "www:www" | chpasswd && adduser www sudo
RUN echo "www ALL=(ALL:ALL) NOPASSWD: ALL" | sudo tee /etc/sudoers.d/www

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
