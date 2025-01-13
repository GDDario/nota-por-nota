FROM nginx:latest

RUN rm -f /etc/nginx/conf.d/default.conf

COPY default.conf /etc/nginx/conf.d/default.conf

ENTRYPOINT ["/docker-entrypoint.sh"]

CMD ["nginx", "-g", "daemon off;"]