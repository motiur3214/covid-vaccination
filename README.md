# Vaccination system

## Requirements

- PHP 8.2 >=
- Laravel 11
- composer install
- npm install
- change .env-example to .env
- give DB credential on env
- give mail trap username and password on env
- php artisan serve
- npm run dev
- create on mySQL database covid_vaccination
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

## Routes
- '/' is for search with nid
- /registration'
- '/dashboard' is after login
- '/register' is user registration
 
## Implementation 
- laravel default auth ui is used
- every requirement is fulfilled 
- layered architecture with clear separations between different concerns
- used queue and scheduler for mail
- optimized query for quick search response
- cached search result for faster response
- route cache for serving request faster

- If i had more time i would like to do test cases

