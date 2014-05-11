#!/bin/bash

# Upgrades PEAR.
pear upgrade PEAR

# XSL for phpDox and XDebug for code coverage.
aptitude install -y php5-xsl php5-xdebug

# PHPUnit.
pear config-set auto_discover 1
pear channel-discover pear.netpirates.net
pear install pear.phpqatools.org/phpqatools theseer/phpDox-alpha

# CS Fixer.
cd /usr/local/bin/
curl -O http://cs.sensiolabs.org/get/php-cs-fixer.phar
chmod +x php-cs-fixer.phar
ln -s php-cs-fixer.phar php-cs-fixer