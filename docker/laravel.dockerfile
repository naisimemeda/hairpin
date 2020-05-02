FROM php:7.4-fpm

ADD sources.list /etc/apt/sources.list

RUN apt-get clean \
    && cd /var/lib/apt \
    && mv lists lists.old \
    && mkdir -p lists/partial \
    && apt-get clean \
    && echo "deb http://mirrors.aliyun.com/debian/ buster main non-free contrib \n \
        deb-src http://mirrors.aliyun.com/debian/ buster main non-free contrib \n \
        deb http://mirrors.aliyun.com/debian-security buster/updates main \n \
        deb-src http://mirrors.aliyun.com/debian-security buster/updates main \n \
        deb http://mirrors.aliyun.com/debian/ buster-updates main non-free contrib \n \
        deb-src http://mirrors.aliyun.com/debian/ buster-updates main non-free contrib" > /etc/apt/sources.list \
    # 更新及安装库
    && apt-get update \
    && apt-get install -y libmagickwand-dev libmcrypt-dev libpq-dev libzip-dev zip vim curl \
    # PHP扩展安装
    && docker-php-ext-install -j$(nproc) gd iconv pdo_mysql bcmath pgsql pdo_pgsql opcache \
    && pecl install redis-5.1.1 zip mcrypt \
    && docker-php-ext-enable redis mcrypt zip


ADD php.ini /usr/local/etc/php/php.ini

# OPcache
COPY opcache.ini /home/opcache.ini
RUN cat /home/opcache.ini >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

# Install composer
COPY composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer


# Chinese mirror
RUN /usr/local/bin/composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/

# Write Permission
RUN usermod -u 1000 www-data

# Create directory
RUN mkdir /docker/www -p
RUN mkdir /docker/log/php7 -p

RUN chown -R www-data.www-data /docker/www /docker/log/php7

RUN touch /docker/log/php7/php_errors.log && chmod 777 /docker/log/php7/php_errors.log

CMD ["php-fpm"]
