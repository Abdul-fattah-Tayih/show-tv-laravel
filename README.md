## SHOW TV
Simple laravel application that stores series and episodes, likes, dislikes and follows, with a simple admin side to CRUD series and episodes.

To get started, clone the repository

``` composer install ```

``` npm install ```

``` cp .env.example .env ```

``` php artisan key:generate ```

Fill your database info then

``` php artisan migrate ```

``` php artisan db:seed ```

``` php artisan admin:create ```

```npm run prod ```

Go ahead and create series/episodes, once you are done ``` php artisan cache:clear ``` to empty cache and display the series links on the navbar
