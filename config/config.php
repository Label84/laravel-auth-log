<?php

use Illuminate\Auth\Events\Attempting;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;

return [
    /*
     * Enable/Disable the logging to the database.
     */
    'enabled' => env('AUTH_LOG_ENABLED', true),

    /*
     * The database table name.
     */
    'table_name' => 'authentication_logs',

    /*
     * The database connection for the authentication_logs table.
     *
     * Leave unchanged to use the Laravel default.
     */
    'database_connection' => env('DB_CONNECTION', 'mysql'),

    /*
     * All events that the package will log to the database.
     */
    'events' => [
        Registered::class,
        Attempting::class,
        // \Illuminate\Auth\Events\Authenticated::class,
        Login::class,
        Failed::class,
        // \Illuminate\Auth\Events\Validated::class,
        Verified::class,
        // \Illuminate\Auth\Events\Logout::class,
        // \Illuminate\Auth\Events\CurrentDeviceLogout::class,
        // \Illuminate\Auth\Events\OtherDeviceLogout::class,
        Lockout::class,
        PasswordReset::class,
    ],
];
