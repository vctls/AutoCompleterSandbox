PUGXAutoCompleter Sandbox
=========================

This is a demo project for [PUGXAutoCompleterBundle](https://github.com/PUGX/PUGXAutoCompleterBundle).

It's basically a [Symfony Standard Edition](https://github.com/symfony/symfony-standard) with some small additions.

It's using [Select2 3.5.3](http://select2.github.io/select2/) for JavaScript part. **Not** working with Select2 4.

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

The Demo
--------

This demo shows a list of books, and let you add a new book. When inserting a new book, you can autocomplete
the author by name.

All the code shoul be self-explainatory, and it's kept to bare minimum for the purposes of this demo.
The only exception is the "add new" feature (see next point).

Add new
-------

Beside the main feature (that is, of course, autocomplete), this demo also shows how to implement an "add new" feature.
With such feature, you can let users add new elements to the existing ones.
If you don't need such feature, you can remove the relevant parts of JavaScript (see comments inside the code).
