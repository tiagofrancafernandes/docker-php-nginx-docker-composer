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
    npm \
    sudo \
    curl 

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN cd /tmp
RUN bash -l -c "wget https://raw.githubusercontent.com/creationix/nvm/v0.34.0/install.sh  -O /tmp/nvm_install.sh"

RUN chmod a+x  /tmp/nvm_install.sh
RUN bash -c "/tmp/nvm_install.sh"
RUN bash -l -c "source $HOME/.bashrc"
RUN cd /tmp
RUN bash -l -c "nvm install 12.13.1"
RUN bash -l -c "node -v"

# Install extensions
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql pdo_sqlite mbstring zip exif pcntl
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
RUN curl https://getcomposer.org/download/1.7.3/composer.phar --output /usr/local/bin/composer1 && \
 chmod +x /usr/local/bin/composer1

RUN curl https://getcomposer.org/download/2.0.8/composer.phar --output /usr/local/bin/composer && \
 chmod +x /usr/local/bin/composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www
RUN echo "www:www" | chpasswd && adduser www sudo

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
