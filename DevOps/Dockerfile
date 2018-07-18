FROM php:7.2-apache


RUN echo "Install libs & PHP extensions" \
    && apt-get update && apt-get install -y wget vim zip libfreetype6-dev libjpeg62-turbo-dev \
    libmcrypt-dev libssl-dev git libxml2-dev libxslt1-dev libicu-dev \
    && echo "Install Composer" && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

ADD ./cli /var/www/html/cli
ADD ./config /var/www/html/config
ADD ./public /var/www/html/public
ADD ./src /var/www/html/src
ADD ./.env ./composer.json ./composer.lock /var/www/html/

ADD ./DevOps/php.ini /usr/local/etc/php/php.ini
COPY ./DevOps/server.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html/

RUN composer self-update && \
    composer install --verbose --prefer-dist --no-interaction --no-dev --optimize-autoloader --no-suggest --no-scripts && \
    composer dump-autoload

EXPOSE 80

CMD /var/www/html/cli/start-server.sh