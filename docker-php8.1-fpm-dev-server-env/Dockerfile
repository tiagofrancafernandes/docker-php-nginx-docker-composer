FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www/app

RUN apt-get -qq update

## Install dependencies
RUN DEBIAN_FRONTEND=noninteractive apt-get install -y \
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
    sqlite3 \
    wget \
    sudo \
    curl \
    postgresql-client-common \
    postgresql-client \
    net-tools \
    iputils-ping \
    procps

##Instal HSTR - https://github.com/dvorka/hstr/blob/master/INSTALLATION.md
RUN apt-get install hstr

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

##################################################
## Install extensions
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql

RUN docker-php-ext-install gd pdo_pgsql pdo_sqlite mbstring zip exif pcntl

## Install xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

## Install mongodb
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

## Install redis
RUN pecl install -o -f redis \
    &&  docker-php-ext-enable redis

RUN rm -rf /tmp/pear
##################################################

## Install composer
RUN curl https://getcomposer.org/download/latest-2.2.x/composer.phar --output /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer

## Install Psy Shell - https://psysh.org/
RUN curl https://psysh.org/psysh --output /usr/local/bin/psysh && \
    chmod +x /usr/local/bin/psysh

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www
RUN echo "www:www" | chpasswd && adduser www sudo
RUN echo "www ALL=(ALL:ALL) NOPASSWD: ALL" | sudo tee /etc/sudoers.d/www

# Copy existing application directory contents
COPY . /var/www/app

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/app

# Change current user to www
USER www

## HSTR config
RUN hstr --show-configuration >> /home/www/.bashrc


# Expose port 9000, start php-fpm server and others
EXPOSE 9000 8000 8080
CMD ["php-fpm"]
