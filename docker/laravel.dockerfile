FROM php:7.4-fpm

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
    && apt-get install -y libmagickwand-dev libmcrypt-dev libpq-dev libzip-dev zip \
    # PHP扩展安装
    && docker-php-ext-install -j$(nproc) gd iconv pdo_mysql bcmath pgsql pdo_pgsql \
    && pecl install redis-5.1.1 zip mcrypt \
    && docker-php-ext-enable redis mcrypt zip
