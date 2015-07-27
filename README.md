# Laravel Analytcs


## How to install

```
composer require baconfy/laravel-analytics
```

config/app.php

```
...
'providers' => [
    Baconfy\Analytics\Providers\AnalyticsServiceProvider::class,
],
...
```

## Execute

```
php artisan migrate

php artisan vendor:publish
```