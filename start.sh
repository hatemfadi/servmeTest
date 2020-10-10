composer install
chmod 777 -R storage
php artisan key:generate
php artisan migrate
php artisan db:seed
echo "************ Please Use Password grant client created below for authentication. *************"
php artisan passport:install
echo "*********************************************************************************************"
php artisan servme:fetch-user

/usr/bin/supervisord -n
