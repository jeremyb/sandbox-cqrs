ARG PHP_VERSION=7.2
ARG ALPINE_VERSION=3.7
FROM php:${PHP_VERSION}-cli-alpine${ALPINE_VERSION}

RUN apk add --no-cache git

RUN set -xe \
	&& apk add --no-cache --virtual .build-deps \
		$PHPIZE_DEPS \
		icu-dev \
		postgresql-dev \
		zlib-dev \
	&& docker-php-ext-install -j$(nproc) \
		intl \
		pdo_pgsql \
		zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer global require "hirak/prestissimo:^0.3" --prefer-dist --no-progress --no-suggest --classmap-authoritative \
	&& composer clear-cache
ENV PATH="${PATH}:/root/.composer/vendor/bin"

WORKDIR /usr/src/app

# Prevent Symfony Flex from generating a project ID at build time
ARG SYMFONY_SKIP_REGISTRATION=1

ARG APP_ENV=dev

# Prevent the reinstallation of vendors at every changes in the source code
COPY composer.json composer.lock ./
RUN composer install --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress --no-suggest \
	&& composer clear-cache

COPY . ./

RUN mkdir -p var/cache var/log var/sessions \
	&& composer dump-autoload --classmap-authoritative --no-dev \
	&& composer run-script --no-dev post-install-cmd \
	&& chmod +x bin/console && sync
VOLUME /usr/src/app/var

CMD ["php"]
