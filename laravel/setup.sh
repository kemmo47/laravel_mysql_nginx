#!/bin/sh
set -e
echo 'Đang chạy npm install'
npm install

echo 'Đang chạy npm run prod'
npm run prod

php-fpm
exec "$@"