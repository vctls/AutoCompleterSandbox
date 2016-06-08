PUGXAutoCompleter Sandbox
=========================

This is a demo project for [PUGXAutoCompleterBundle](https://github.com/PUGX/PUGXAutoCompleterBundle).

It's basically a [Symfony Standard Edition](https://github.com/symfony/symfony-standard) with some small additions.

Setup
-----

* clone this repository
* run `composer install`
* run `bin/console doctrine:database:create`
* run `bin/console doctrine:schema:update --force`
* run `bin/console faker:populate`
* run `bin/console server:run`

After the last command, you should be able to browse the application in `http://127.0.0.1:8000`.

Testing
-------

You can test the application running `bin/phpunit`.

Be aware, since testing are really basic and based on some hard-coded values in database.
If tests fail, try to drop database, re-create it and re-populate.