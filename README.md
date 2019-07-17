# Los Huevos de Natalia
### A fancy form to buy easter eggs and an admin panel to have a look to orders placed.

![App screenshot](https://raw.githubusercontent.com/tpenaranda/loshuevosdenati/master/screenshot.png)

## Requirements

* PHP >= 7.1.3
    * BCMath PHP Extension
    * Ctype PHP Extension
    * JSON PHP Extension
    * Mbstring PHP Extension
    * OpenSSL PHP Extension
    * PDO PHP Extension
    * Tokenizer PHP Extension
    * XML PHP Extension
* MySQL
* npm

# Install

1. `git clone git@github.com:tpenaranda/loshuevosdenati`

2. Rename `.env.example` file to `.env` and configure DB values

3. Create database.

4. `composer update`

5. `php artisan migrate --seed`

6. `php artisan key:generate`

7. `npm install`

8. `npm run dev`

9. `php artisan serve` to start dev server.

## Tests (PHP SQLite driver required)
`vendor/phpunit/phpunit/phpunit`
