Comandos rodados ao criar o projeto (desde o início):

composer install
cp .env.example .env
php artisan migrate
php artisan db:seed
php artisan key:generate
php artisan make:controller IndexController
php artisan make:controller ProcessController
php artisan make:model CategoryModel
php artisan make:model DocumentModel