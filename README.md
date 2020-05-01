# students-api

A simple REST API supporting CRUD operations on students and their grades.
Made with Symfony 5, Docker and API Platform.

Installation
------------

* Install [Docker][1] if it's not already done.
* Build and start containers:

```
cd docker

docker-compose up
```

Database
--------

When database and php-fpm containers are up, you can execute Doctrine migrations and optionally load fixtures:

```
docker-compose run php-fpm bin/console doctrine:migrations:migrate

docker-compose run php-fpm bin/console doctrine:fixtures:load
```

API documentation
-----------------

You can read the API documentation [here][2].

[1]: https://docs.docker.com/get-docker/
[2]: http://localhost/api
