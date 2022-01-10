<?php

namespace Label84\AuthLog\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Label84\AuthLog\Listeners\LogAuthAction;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \Illuminate\Auth\Events\Attempting::class => [LogAuthAction::class],
        \Illuminate\Auth\Events\Authenticated::class => [LogAuthAction::class],
        \Illuminate\Auth\Events\Failed::class => [LogAuthAction::class],
        \Illuminate\Auth\Events\Lockout::class => [LogAuthAction::class],
        \Illuminate\Auth\Events\Login::class => [LogAuthAction::class],
        \Illuminate\Auth\Events\Logout::class => [LogAuthAction::class],
        \Illuminate\Auth\Events\OtherDeviceLogout::class => [LogAuthAction::class],
        \Illuminate\Auth\Events\PasswordReset::class => [LogAuthAction::class],
        \Illuminate\Auth\Events\Registered::class => [LogAuthAction::class],
        \Illuminate\Auth\Events\Verified::class => [LogAuthAction::class],
    ];

    public function boot(): void
    {
        parent::boot();
    }
}
