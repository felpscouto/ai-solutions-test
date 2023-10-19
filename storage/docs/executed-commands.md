Comandos rodados ao criar o projeto (desde o início):

composer install
cp .env.example .env
php artisan migrate
php artisan db:seed
php artisan key:generate
php artisan make:job ProcessDocumentsQueue
php artisan make:controller ProcessDocumentsController