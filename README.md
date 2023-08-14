## About

Simple project to load data in queues from external API provider

### Setup

cp .env.example .env

docker-compose up --build
docker-compose exec php composer install
docker-compose exec php php artisan key:generate
docker-compose exec php php artisan queue:work

### Command to import and create jobs in queue

docker-compose exec php php artisan import:boxes
