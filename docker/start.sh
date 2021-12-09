#!/bin/sh

if [ "${ENV}" = "PROD" ]
then
  composer install --no-dev --optimize-autoloade
else
  composer install
fi

php-fpm