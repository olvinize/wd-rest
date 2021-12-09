ARG PHP_VERSION=7.4

# Set master image
FROM php:${PHP_VERSION}-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install Additional dependencies
RUN apk update && apk add --no-cache \
shadow tzdata

# Install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Remove Cache
RUN rm -rf /var/cache/apk/*

# Change current user to www
USER www-data

COPY --chown=www-data:www-data start.sh ../start.sh
RUN chmod u+x ../start.sh

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["../start.sh"]