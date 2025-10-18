FROM php:8.1-apache

# Set shell options for better error handling
SHELL ["/bin/bash", "-o", "pipefail", "-c"]

# System + PHP-Build-Deps
# hadolint ignore=DL3008,SC2086
RUN rm -rf /var/www/html \
    && mkdir -p /var/www/public \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        ca-certificates \
        default-mysql-client \
        gnupg \
        imagemagick \
        libmagickwand-dev \
        libicu-dev \
        libonig-dev \
        libpng-dev \
        libpq-dev \
        libzip-dev \
        postgresql-client \
        unzip zip \
        $PHPIZE_DEPS

# PHP Config
COPY php/php.ini /usr/local/etc/php/php.ini
COPY php/conf.d/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# PHP Extensions
RUN docker-php-ext-configure intl \
    && docker-php-ext-install -j"$(nproc)" \
      bcmath exif gd intl mbstring pcntl pdo_mysql pgsql pdo_pgsql zip

RUN pecl install apcu \
    && pecl install redis \
    && pecl install imagick \
    && pecl install xdebug \
    && docker-php-ext-enable apcu redis imagick

# hadolint ignore=SC2086
RUN apt-get purge -y --auto-remove libmagickwand-dev libpq-dev $PHPIZE_DEPS \
    && rm -rf /var/lib/apt/lists/* /var/cache/apt/archives/*

# Composer
RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls
RUN mv composer.phar /usr/local/bin/composer
COPY composer/keys.dev.pub /root/.composer/keys.dev.pub
COPY composer/keys.tags.pub /root/.composer/keys.tags.pub

# symfony-cli
# hadolint ignore=DL3008
RUN curl -fsSL https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh | bash \
    && apt-get update \
    && apt-get install -y --no-install-recommends symfony-cli \
    && rm -rf /var/lib/apt/lists/* /var/cache/apt/archives/*

# Apache vhost + SSL + rewrite
COPY apache/config/server.conf /etc/apache2/conf-available/server.conf
RUN ln -s /etc/apache2/conf-available/server.conf /etc/apache2/conf-enabled/server.conf
COPY apache/vhost/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY apache/vhost/default-ssl.conf /etc/apache2/sites-available/default-ssl.conf
RUN ln -s /etc/apache2/sites-available/default-ssl.conf /etc/apache2/sites-enabled/default-ssl.conf
COPY apache/certificate/cert.pem /etc/ssl/certs/cert.pem
COPY apache/certificate/key.pem /etc/ssl/private/key.pem

RUN a2enmod ssl rewrite

# Entrypoint script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

WORKDIR /var/www

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
