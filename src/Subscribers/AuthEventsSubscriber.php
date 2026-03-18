<?php

namespace Label84\AuthLog\Subscribers;

use Illuminate\Auth\Events\Attempting;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\CurrentDeviceLogout;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\OtherDeviceLogout;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Validated;
use Illuminate\Auth\Events\Verified;
use Illuminate\Events\Dispatcher;
use Label84\AuthLog\Listeners\LogAuthAction;

class AuthEventsSubscriber
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen(Registered::class, [LogAuthAction::class, 'handle']);
        $events->listen(Attempting::class, [LogAuthAction::class, 'handle']);
        $events->listen(Authenticated::class, [LogAuthAction::class, 'handle']);
        $events->listen(Login::class, [LogAuthAction::class, 'handle']);
        $events->listen(Failed::class, [LogAuthAction::class, 'handle']);
        $events->listen(Validated::class, [LogAuthAction::class, 'handle']);
        $events->listen(Verified::class, [LogAuthAction::class, 'handle']);
        $events->listen(Logout::class, [LogAuthAction::class, 'handle']);
        $events->listen(CurrentDeviceLogout::class, [LogAuthAction::class, 'handle']);
        $events->listen(OtherDeviceLogout::class, [LogAuthAction::class, 'handle']);
        $events->listen(Lockout::class, [LogAuthAction::class, 'handle']);
        $events->listen(PasswordReset::class, [LogAuthAction::class, 'handle']);
    }
}
