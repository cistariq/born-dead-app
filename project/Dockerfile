FROM php:8.1-fpm

# تثبيت الحزم المطلوبة
RUN apt-get update && apt-get install -y \
    unzip libaio1 libzip-dev zip curl libpng-dev libonig-dev libxml2-dev git wget \
    && docker-php-ext-install pdo pdo_mysql zip

# تحميل Oracle Instant Client (basic + sdk)
WORKDIR /opt/oracle

COPY oracle/instantclient-basiclite-linux.x64-12.2.0.1.0.zip .
COPY oracle/instantclient-sdk-linux.x64-12.2.0.1.0.zip .

RUN unzip instantclient-basiclite-linux.x64-12.2.0.1.0.zip &&
unzip instantclient-sdk-linux.x64-12.2.0.1.0.zip &&
rm *.zip &&
mkdir -p /usr/lib/oracle/12.2/client64/lib &&
mv instantclient_12_2 /usr/lib/oracle/12.2/client64/lib
# تعيين متغير البيئة
ENV LD_LIBRARY_PATH /opt/oracle/instantclient_21_12

# تثبيت امتداد oci8
RUN echo 'instantclient,/opt/oracle/instantclient_21_12' | pecl install oci8 && \
    docker-php-ext-enable oci8

# تثبيت Composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

# نسخ ملفات Laravel إلى داخل الحاوية
WORKDIR /var/www

COPY . .

RUN composer install

CMD ["php-fpm"]
