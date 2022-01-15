# Laravel Auth Log

[![Latest Stable Version](https://poser.pugx.org/label84/laravel-auth-log/v/stable?style=flat-square)](https://packagist.org/packages/label84/laravel-auth-log)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Quality Score](https://img.shields.io/scrutinizer/g/label84/laravel-auth-log.svg?style=flat-square)](https://scrutinizer-ci.com/g/label84/laravel-auth-log)
[![Total Downloads](https://img.shields.io/packagist/dt/label84/laravel-auth-log.svg?style=flat-square)](https://packagist.org/packages/label84/laravel-auth-log)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/label84/laravel-auth-log/run-tests?label=Tests&style=flat-square)

The ``laravel-auth-log`` package will log all the default Laravel authentication events (Login, Attempting, Lockout, etc.) to your database. In the config file you can select the events that you would like to log. It will save the event name, email, user id, ip address and user agent to the database. No other configurations are required. This package could be useful for tracking unwanted activity in your Laravel application.

- [Requirements](#requirements)
- [Laravel support](#laravel-support)
- [Installation](#installation)
- [Usage](#usage)
- [Tests](#tests)
- [License](#license)

## Requirements

- Laravel 8.x or 9.x

## Laravel support

| Version | Release |
|---------|---------|
| 9.x     | 1.1     |
| 8.x     | 1.0     |

## Installation

### 1. Install the package via composer

```sh
composer require label84/laravel-auth-log
```

### 2. Publish the config file and migration

```sh
php artisan vendor:publish --provider="Label84\AuthLog\AuthLogServiceProvider" --tag="config"
php artisan vendor:publish --provider="Label84\AuthLog\AuthLogServiceProvider" --tag="migrations"
```

### 3. Run migration

```sh
php artisan migrate
```

## Usage

In the config file ``config/authlog.php`` you can (un)comment the events that you'd like to log to your database. 

```php
// config/authlog.php

return [
    // ...
    'events' => [
        \Illuminate\Auth\Events\Attempting::class,
        // \Illuminate\Auth\Events\Authenticated::class,
        \Illuminate\Auth\Events\Failed::class,
        \Illuminate\Auth\Events\Lockout::class,
        \Illuminate\Auth\Events\Login::class,
        \Illuminate\Auth\Events\Logout::class,
        \Illuminate\Auth\Events\OtherDeviceLogout::class,
        \Illuminate\Auth\Events\PasswordReset::class,
        \Illuminate\Auth\Events\Registered::class,
        \Illuminate\Auth\Events\Verified::class,
    ],
];
```

In the same file you can can also change the database connection and table name.

### Enable/disable logging

You can add the ``AUTH_LOG_ENABLED=`` to your ``.env`` file to enable/disable the logging.

```php
// .env

AUTH_LOG_ENABLED=true
```

### Table format example

| id | event_name | email | user_id | ip_address | user_agent | context | created_at |
|-|-|-|-|-|-|-|-|
| 1 | Attempting | info@example.org | | 127.0.0.1 | Mozilla/5.0 (Windows NT 10.0... | | 2022-01-10 00:00:00 |
| 2 | Login | | 1 | 127.0.0.1 | Mozilla/5.0 (Windows NT 10.0... | | 2022-01-10 00:00:00 |

## Tests

```sh
./vendor/bin/phpstan analyse
./vendor/bin/phpunit
```

## License

[MIT](https://opensource.org/licenses/MIT)
