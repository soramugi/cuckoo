#!/bin/bash

set -eux

ROOT_DIR=`pwd`
TEMP_DIR=$(mktemp -d)
trap 'rm -rf $TEMP_DIR' EXIT

cd $TEMP_DIR

git clone $ROOT_DIR .

composer install --optimize-autoloader --no-dev

npm install
npm run build
rm -rf node_modules/

cp .env.distribution .env
touch storage/db.sqlite

php artisan key:generate
php artisan migrate

zip -r $ROOT_DIR/cuckooremind.zip .

# chmod -R 705 . # 設置後にパーミッション変更
