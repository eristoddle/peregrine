#!/bin/bash

echo '### Phalcon php extension ###'

# Get su permission
sudo su

srcdir=`mktemp --tmpdir -d cphalcon.XXXXXX`

# Clone the repo
git clone --depth=1 https://github.com/phalcon/cphalcon.git ${srcdir}
cd ${srcdir}

# Test if an update is necessary
touch /var/phalcon-head
INSTALLED_HEAD=$(cat /var/phalcon-head)
REPO_HEAD=$(cat .git/refs/heads/master)

if [ "$INSTALLED_HEAD" == "$REPO_HEAD" ]; then
# Do nothing
echo
echo 'PHP extension for Phalcon is up to date'
echo
else
# Install/Update Phalcon
echo
echo 'Building Phalcon'
echo

cd build
./install
wait

# write ini config
if ! (php --ri phalcon &>/dev/null); then
if [ -d "/etc/php5/mods-available" ]; then
echo 'extension=phalcon.so' > /etc/php5/mods-available/phalcon.ini
[ -d '/etc/php5/cli' ] && ln -s /etc/php5/mods-available/phalcon.ini /etc/php5/cli/conf.d/phalcon.ini
[ -d '/etc/php5/apache' ] && ln -s /etc/php5/mods-available/phalcon.ini /etc/php5/apache/conf.d/phalcon.ini
[ -d '/etc/php5/fpm' ] && ln -s /etc/php5/mods-available/phalcon.ini /etc/php5/fpm/conf.d/phalcon.ini
else
echo 'Cannot find PHP modules directory. You should write phalcon.ini manually' >&2
fi
fi

# Restart apache
echo
echo 'Restarting Apache'
echo
service apache2 status &>/dev/null && service apache2 restart

# Update the installed HEAD
cd ../
cat .git/refs/heads/master > /var/phalcon-head

echo
echo 'Phalcon has been updated'
echo
fi

rm -rf ${srcdir}

exit

cd /home/`whoami`
