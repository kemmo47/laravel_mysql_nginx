set -ea

cd /var/www/html

echo 'Đang chạy laravel npm install ------------------------------------------>'
npm install 

npm run prod

echo 'Đang chạy laravel npm php-fpm ------------------------------------------>'
php-fpm