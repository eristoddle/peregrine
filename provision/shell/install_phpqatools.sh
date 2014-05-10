#!/bin/bash
sudo su
pear upgrade PEAR
pear config-set auto_discover 1
pear install pear.phpqatools.org/phpqatools