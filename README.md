# Los Huevos de Natalia
## Nati hace los huevos, vos los comprás.

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
