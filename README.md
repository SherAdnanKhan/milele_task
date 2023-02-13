# Setting Up  Project

##After Cloning Project

#### Open in IDE

####Check ".env-example" and rename it to ".env"

####Setup DB CONNECTION 

####Change APP_URL  according to your Virtualhost url

#### env file change
```ssh
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```
#####INTO
```ssh
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465 
MAIL_USERNAME=youremail@gmail.com
MAIL_PASSWORD=yourpassword
MAIL_ENCRYPTION=ssl
```)
install composer
Composer install
#### Then Open Terminal an go to your folder path and setup Laravel...

```sh
php artisan key:generate
php artisan config:cache
php artisan cache:clear
php artisan migrate
php artisan db:seed

composer update
php artisan config:cache
php artisan cache:clear
```

run through php artisan serve or local host



