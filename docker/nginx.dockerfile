FROM nginx

COPY ./vhost.conf /etc/nginx/conf.d/default.conf
