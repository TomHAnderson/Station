# Contributions are welcome!
More details will come as we flesh out some of the details. But until then, this is the guide.

## Quick guide:

 * Fork the repo.
 * Create branch, e.g. feature-foo or bugfix-bar.
 * Add/update the tests!
 * Make sure tests pass.
 * Create a pull request

## Pull Requests

 * Submit one PR per fix or feature.
 * Follow the conventions used in the project.
 * Remember the tests and documentation.


## Installing

```
git clone git@github.com:sfphp/sfphp.org
cd sfphp.org
php -r "readfile('https://getcomposer.org/installer');" | php
./composer.phar install
cp config/autoload/local.php.dist config/autoload/local.php
```

## Testing

Testing will be done using PHPUnit. We have travis-ci setup to do testing of each PR before merging.

```
./vendor/bin/phpunit
```

## Coding Standards
We will be following PSR-0, PSR-1 & PSR-2 standards augmented with Doctrine coding standards. We will use [fabpot/php-cs-fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) to enforce them.  To run php-cs-fixer use ```vendor/bin/php-cs-fixer --config-file=./.php_cs```

 * [PSR-1: Basic Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md)
 * [PSR-2: Coding Style Guide](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)
 * [Doctrine Coding Standard](https://github.com/deeky666/doctrine-coding-standard/blob/master/Docs/README.md)

Libraries should follow PSR-4 and may follow PSR-0

* [PSR-4 Autoloader](http://www.php-fig.org/psr/psr-4/)

```
./vendor/bin/php-cs-fixer fix .
```

## Misc
 * If you contribute, go ahead and add yourself to the composer.json
 * GitHub will send tweets to sf_php after code pushes/merges
 * will add people with push access once we start getting standards in place.
 * database will be either mysql or mongodb. decision on which will come after we eval needs after looking at Jacob's specs.
