#!/bin/bash

#this script will update the class map of our project

php composer.phar dump-autoload
php composer.phar update