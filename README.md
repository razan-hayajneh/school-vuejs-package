# School Package Using VueJs3

## 1.before install school package, require use this commands:
    composer require laravel/jetstream
    php artisan jetstream:install inertia 
    composer require fideloper/proxy
    composer require uxweb/sweet-alert


## 2.install library
    composer require vue-system\school

## 3.in config->app.php add to providers array
    VueSystem\School\SchoolServiceProvider::class,
## then run in terminal:
    php artisan vendor:publish --fource
## 4.Database Migration
    php artisan migrate --seed
## 5.npm
    npm install 
    npm run dev

