sfphp.org
=========

The code that will be what runs sfphp.org


Install
-------

```
git clone git@github.com:sfphp/sfphp.org
cd sfphp.org
php -r "readfile('https://getcomposer.org/installer');" | php
./composer.phar install
cp config/autoload/local.php.dist config/autoload/local.php
```
Edit local.php with your db connection and your OAuth2 consumer.
See /etc/hosts note below.
Remove your old data/sqlite.db file

```
php public/index.php development enable
php public/index.php orm:schema-tool:create
php public/index.php data-fixture:import

cd public
bower install
```

The application is now ready to run.  You may do so with the default
instructions above by adding dev-yourusername.sfphp.org to your /etc/hosts
then running
```
php -S dev-yourusername.sfphp.org:80 -t public/ public/index.php
```

/etc/hosts note
---------------

Running with a custom host name allows you to set an OAuth2 consumer with meetup.  You cannot do this with localhost:####
