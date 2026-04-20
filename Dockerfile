#syntax=docker/dockerfile:1.4

ARG PHP_VERSION=8.4.20

FROM php:${PHP_VERSION}-fpm-alpine3.23 AS php_base

WORKDIR /app

RUN apk add --no-cache \
		acl \
		bash \
	;

RUN set -eux; \
	apk add --no-cache --virtual .build-deps \
		${PHPIZE_DEPS} \
		icu-data-full \
		icu-dev \
		libzip-dev \
	; \
	docker-php-ext-configure zip; \
	docker-php-ext-install -j$(nproc) \
		intl \
        pdo_mysql \
	; \
	docker-php-ext-enable \
		opcache \
	; \
	runDeps="$( \
		scanelf --needed --nobanner --format '%n#p' --recursive /usr/local/lib/php/extensions \
			| tr ',' '\n' \
			| sort -u \
			| awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
	)"; \
	apk add --no-cache --virtual .phpexts-rundeps ${runDeps}; \
	apk del .build-deps; \
	rm -rf /tmp/*

COPY --link --from=composer/composer:2.9-bin /composer /usr/bin/composer

RUN ln -s ${PHP_INI_DIR}/php.ini-production ${PHP_INI_DIR}/php.ini; \
    sed -i "s/access.log\(.*\)/access.log = \/proc\/self\/fd\/1/" /usr/local/etc/php-fpm.d/docker.conf

# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"

COPY --link composer.* symfony.lock ./
RUN set -eux; \
	composer install --prefer-dist --no-dev --no-scripts --no-progress; \
	composer clear-cache

COPY --link . ./
RUN rm -Rf docker/

CMD ["php-fpm"]
