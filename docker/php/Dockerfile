FROM php:7.2-fpm

#   Set working directory
WORKDIR /var/www/html

#   Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libjpeg-dev \
    libxpm-dev \
    libwebp-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    zlib1g-dev \
    libicu-dev \
    jpegoptim \
    g++ \
    libxrender1 \
    libfontconfig \
    nano \
    cron

#   Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

#   Install basic extensions
RUN docker-php-ext-install intl \
    && docker-php-ext-install zip \
    && docker-php-ext-install bcmath

#   Install mcrypt extension
RUN pecl install mcrypt-1.0.2\
    && docker-php-ext-enable mcrypt

#   Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#   Install MySQL PDO
ARG INSTALL_MYSQL=false
RUN if [ ${INSTALL_MYSQL} = true ]; then \
    docker-php-ext-install pdo pdo_mysql \
    ;fi

#   Install GD library
ARG INSTALL_GD=false
RUN if [ ${INSTALL_GD} = true ]; then \
    docker-php-ext-configure gd \
    --with-freetype-dir=/usr/include/ \
    --with-jpeg-dir=/usr/include/ \
    --with-png-dir=/usr/include/ \
    --with-xpm-dir=/usr/include/ \
    --with-webp-dir=/usr/include/ > /dev/null && \
    docker-php-ext-install gd > /dev/null \
    ;fi

#   Install XDebug extention PDO
ARG INSTALL_XDEBUG=false
RUN if [ ${INSTALL_XDEBUG} = true ]; then \
    pecl install xdebug-3.1.2 && docker-php-ext-enable xdebug \
    ;fi

#   Add user for laravel application
ARG APP_USER=user
RUN groupadd -g 1000 ${APP_USER}
RUN useradd -u 1000 -ms /bin/bash -g ${APP_USER} ${APP_USER}

#   Copy existing application directory contents
COPY . /var/www/html

#   Copy existing application directory permissions
COPY --chown=${APP_USER}:${APP_USER} . /var/www/html

#   Change user
USER ${APP_USER}

#   Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]