# SLIM 4 - API FOR CHURCH APP

SLIM FRAMEWORK [Slim PHP micro-framework](https://www.slimframework.com).


[![Software License][ico-license]](LICENSE.md)
[![Build Status](https://travis-ci.com/maurobonfietti/slim4-api-skeleton.svg?branch=master)](https://travis-ci.com/maurobonfietti/slim4-api-skeleton)
[![Coverage Status](https://coveralls.io/repos/github/maurobonfietti/slim4-api-skeleton/badge.svg?branch=master)](https://coveralls.io/github/maurobonfietti/slim4-api-skeleton?branch=master)
[![Packagist Version](https://img.shields.io/packagist/v/maurobonfietti/slim4-api-skeleton)](https://packagist.org/packages/maurobonfietti/slim4-api-skeleton)

[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat

## :computer: TECHNOLOGIES USED:

The main technologies used in this project are:

- PHP 8
- Slim 4
- MySQL
- PHPUnit
- dotenv
- Docker
- Docker Compose

## :gear: QUICK INSTALL:

### Requirements:

- Composer.
- PHP >= 8.1
- MySQL/MariaDB.
- or Docker.


### With Git:

You can create a new project running the following commands:

```bash
git clone git@github.com:nzian/churchapp.git [my-api-name]
cd [my-api-name]
composer test
composer start
```


#### Configure your connection to MySQL Server:

By default, the API uses a MySQL database.

You should check and edit this configuration in your `.env` file:

```
DB_HOST='127.0.0.1'
DB_NAME='yourMySqlDatabase'
DB_USER='yourMySqlUsername'
DB_PASS='yourMySqlPassword'
DB_PORT='3306'
```

## Migrations

You can do your migration with bellow command
run this for see available command

``` composer migration ```

You will see all available commands. You also can see the details of the command and with --help you can see more details of the command. Or if you have database tables definition already then either you use reverse migration process to generate migrations file or skip and ready to generate api end points.

## :package: DEPENDENCIES:

### LIST OF REQUIRE DEPENDENCIES:

- [slim/slim](https://github.com/slimphp/Slim): Slim is a PHP micro framework that helps you quickly write simple yet powerful web applications and APIs.
- [slim/psr7](https://github.com/slimphp/Slim-Psr7): PSR-7 implementation for use with Slim 4.
- [pimple/pimple](https://github.com/silexphp/Pimple): A small PHP dependency injection container.
- [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv): Loads environment variables from `.env` to `getenv()`, `$_ENV` and `$_SERVER` auto magically.
- [lulco/phoenix](https://github.com/lulco/phoenix): Database migration with mysql and postgres database

### LIST OF DEVELOPMENT DEPENDENCIES:

- [phpunit/phpunit](https://github.com/sebastianbergmann/phpunit): The PHP Unit Testing framework.
- [symfony/console](https://github.com/symfony/console): The Console component eases the creation of beautiful and testable command line interfaces.
- [nunomaduro/phpinsights](https://github.com/nunomaduro/phpinsights): Instant PHP quality checks from your console.
- [maurobonfietti/slim4-api-skeleton-crud-generator](https://github.com/maurobonfietti/slim4-api-skeleton-crud-generator): CRUD Generator for Slim 4 - Api Skeleton.

## :bookmark: ENDPOINTS:

### BY DEFAULT:

- Hello: `GET /`

- Health Check: `GET /status`

## :heart: SUPPORT THE PROJECT

If you would like to support this project, you can:

- Give a star to the repository :star: :blush:

## :sunglasses: AND THAT'S IT!

Now, go to build an excellent RESTful API.
