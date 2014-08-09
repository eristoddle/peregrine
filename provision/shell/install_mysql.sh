#!/bin/sh
sudo debconf-set-selections <<< 'mysql-server \
 mysql-server/root-password password root'
sudo debconf-set-selections <<< 'mysql-server \
 mysql-server/root_password_again password root'
sudo apt-get install -y php5-mysql mysql-server

cat << EOF | sudo tee -a /etc/mysql/conf.d/default_engine.cnf
[mysqld]
default-storage-engine = MyISAM
EOF

sudo service mysql restart

mysql -u root -proot -e "create database peregrine"