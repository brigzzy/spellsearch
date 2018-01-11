FROM ubuntu

# File Author / Maintainer
MAINTAINER brigzzy

ADD ./html /var/www/html

# Update the repository sources list
RUN apt -yqq update

# Install and run apache
RUN apt -yqq install unzip git curl apache2 php libapache2-mod-php php-mcrypt && apt-get clean

WORKDIR /var/www/html
RUN curl -s http://getcomposer.org/installer | php
RUN php composer.phar install --no-dev

EXPOSE 80
CMD apachectl -D FOREGROUND
