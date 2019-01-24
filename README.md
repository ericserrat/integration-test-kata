Integration tests kata
======================

# Start the project #

Init docker containers:

`docker-compose up -d`

Enter into the docker machine:

`docker-compose exec php-fpm bash`

Navigate into the app directory and install vendors:

`cd app/ && composer install`

Create database:

`vendor/bin/doctrine orm:schema-tool:create`

# Executing the tests #

`vendor/bin/phpunit`

# Accessing to database #

* Database: **db**
* User: **kata**
* Password: **kata**
* Port: **2002**