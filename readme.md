# PHP Project DevTest

## Create a RESTful API Using HTTP Verbs for a /user Endpoint

The project was designed to create an API for management of user module with GET, PUT, DELETE and POST actions.

The attributes of the module are name, email and password.

The test development approach was TDD using PHPUnit.

Language: PHP 7
Framework: Laravel 5.3.*
Database: MySQL

To development environment was used Dockers containers with PHP, MySQL and Nginx server.

To run this project after repository clone, in the main directory on your host, type:

$ docker-compose up

Next we’ll need to set the application key & run the optimize command.

$ docker-compose exec app php artisan key:generate

$ docker-compose exec app php artisan optimize

To create databases, we need run:

$ docker-compose exec app php artisan migrate

And to seed the database with fake information, run:

$ docker-compose exec app php artisan db:seed


