<?php

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
        \Illuminate\Auth\Events\Registered::class,
        \Illuminate\Auth\Events\Attempting::class,
        // \Illuminate\Auth\Events\Authenticated::class,
        \Illuminate\Auth\Events\Login::class,
        \Illuminate\Auth\Events\Failed::class,
        // \Illuminate\Auth\Events\Validated::class,
        \Illuminate\Auth\Events\Verified::class,
        // \Illuminate\Auth\Events\Logout::class,
        // \Illuminate\Auth\Events\CurrentDeviceLogout::class,
        // \Illuminate\Auth\Events\OtherDeviceLogout::class,
        \Illuminate\Auth\Events\Lockout::class,
        \Illuminate\Auth\Events\PasswordReset::class,
    ],
];
