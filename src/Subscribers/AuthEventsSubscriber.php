<?php

namespace Label84\AuthLog\Subscribers;

use Illuminate\Events\Dispatcher;
use Label84\AuthLog\Listeners\LogAuthAction;

class AuthEventsSubscriber
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen(\Illuminate\Auth\Events\Registered::class, [LogAuthAction::class, 'handle']);
        $events->listen(\Illuminate\Auth\Events\Attempting::class, [LogAuthAction::class, 'handle']);
        $events->listen(\Illuminate\Auth\Events\Authenticated::class, [LogAuthAction::class, 'handle']);
        $events->listen(\Illuminate\Auth\Events\Login::class, [LogAuthAction::class, 'handle']);
        $events->listen(\Illuminate\Auth\Events\Failed::class, [LogAuthAction::class, 'handle']);
        $events->listen(\Illuminate\Auth\Events\Validated::class, [LogAuthAction::class, 'handle']);
        $events->listen(\Illuminate\Auth\Events\Verified::class, [LogAuthAction::class, 'handle']);
        $events->listen(\Illuminate\Auth\Events\Logout::class, [LogAuthAction::class, 'handle']);
        $events->listen(\Illuminate\Auth\Events\CurrentDeviceLogout::class, [LogAuthAction::class, 'handle']);
        $events->listen(\Illuminate\Auth\Events\OtherDeviceLogout::class, [LogAuthAction::class, 'handle']);
        $events->listen(\Illuminate\Auth\Events\Lockout::class, [LogAuthAction::class, 'handle']);
        $events->listen(\Illuminate\Auth\Events\PasswordReset::class, [LogAuthAction::class, 'handle']);
    }
}
