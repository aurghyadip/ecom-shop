# Mini Online Shop Service Prototype

## How to install the system?
To install the system, you have to have composer installed. Composer is a PHP package manager which.

Google how to install composer and install composer. With composer install, open terminal or command prompt and navigate to the folder. Inside the folder, run
```
composer install
```
After it has installed all the dependencies, you can finally install the database.
Import the `.sql` files in the system directory in your phpmyadmin or mysql command prompt. Then change the following in the `DB_CONFIG.php` file in the system folder.
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'username'); // change this
define('DB_PASS', 'password'); // change this
define('DB_NAME', 'ecom_shop'); // change this if you have made a different database name
```

After that, copy the whole folder to your `htdocs` or `www` folder and open http://localhost/shop in your browser. 
