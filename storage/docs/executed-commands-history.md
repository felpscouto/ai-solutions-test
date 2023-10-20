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
php artisan queue:table
php artisan migrate
php artisan make:job ProcessDocumentQueueJob
php artisan make:migration add_queue_status_to_documents_table --table=documents
php artisan migrate
php artisan make:migration create_custom_jobs_table
php artisan migrate
php artisan make:model CustomJobsModel