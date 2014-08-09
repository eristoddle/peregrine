#!/bin/sh
echo '### Install Apache2 ###'
sudo apt-get -y install apache2
a2enmod rewrite
sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
sudo update-rc.d apache2 enable
sudo service apache2 restart