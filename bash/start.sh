#!/bin/bash
export COMPOSER_HOME='~/'

# Install Composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" >> dummy.log 
php composer-setup.php
#remove link to setup
php -r "unlink('composer-setup.php');" 
# Move composer.phar to Composer Home

sudo mv composer.phar $COMPOSER_HOME/composer ;
php composer.phar install >>dummy.log
php composer.phar --version >>dummy.log

php composer.phar dump-autoload 
