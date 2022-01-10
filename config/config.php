<?php

return [
    'table_name' => 'authentication_logs',

    'database_connection' => env('DB_CONNECTION', 'mysql'),

    'enabled' => env('AUTH_LOG_ENABLED', true),

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
