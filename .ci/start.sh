#!/bin/bash

set -eux

CURRENT=$(cd $(dirname $0);pwd)
ROOT=$(cd $CURRENT/../;pwd)

cd $ROOT

composer install

./vendor/bin/sail shell \
    ./vendor/bin/pint --test && \
    php artisan test
