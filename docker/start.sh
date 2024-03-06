#!/bin/bash

composer install --no-interaction
sleep 10
# Polecenie migracji Symfony
php bin/console d:m:m