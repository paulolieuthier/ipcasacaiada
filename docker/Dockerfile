FROM wordpress:cli
USER root
WORKDIR /wordpress
RUN chown -R www-data:www-data /wordpress
ADD entrypoint.sh /usr/local/bin/entrypoint.sh
USER www-data
RUN wp core download --version=5.8
RUN ls -l /wordpress
ENTRYPOINT ["entrypoint.sh"]
