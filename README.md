# Vaccination system

## Requirements

- PHP 8.2 >=
- Laravel 12
- composer install
- npm install
- change .env-example to .env
- give DB credential on env
- give mail trap username and password on env
- php artisan storage:link
- php artisan serve
- npm run dev
- create database covid_vaccination
- php artisan migrate
- php artisan db:seed
- php artisan queue:work 
- php artisan schedule:work 
- php artisan route:cache

 ## Happy path 
- search user with nid
- register user
- get a schedule for vaccination 
- search with nid

## Implementation 
- every requirement is fulfilled 
- layered architecture with clear separations between different concerns
- used queue and scheduler for mail
- optimized query for quick search response
- cached search result for faster response
- route cache for serving request faster
