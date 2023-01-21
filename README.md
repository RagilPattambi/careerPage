# career-page


This project is built in PHP using Laravel framework. It serves as a platform between job seeker and provider.

Features
List jobs
Apply for jobs
List application for logged users
Download resume for logged users

API
Login api
Create opening api
Apply for job api
List jobs api
List applications api

Installation
Note: If you receive and error while installation below run composer update instead of composer install also run php artisan key:generate

1. Clone the repository
https://github.com/tusharslife/simple-job-portal.git
2. Set the basic config
Edit example.env to .env
Put your db username and password here with DB_DATABASE=db_careers

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_careers
DB_USERNAME=root
DB_PASSWORD=

3. Update Dependencies
composer update   

4. Migrate Database
php artisan migrate
php artisan db:seed

5. Serve application
php artisan serve
