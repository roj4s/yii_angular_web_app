FROM codemix/yii2-base:2.0.10-php7-apache


COPY composer.json /var/www/html/
COPY composer.lock /var/www/html/
RUN composer self-update --no-progress && \
    composer install --no-progress

COPY . /var/www/html
RUN chown www-data:www-data runtime web/assets

VOLUME ["/var/www"]