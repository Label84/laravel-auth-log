<?php

namespace Label84\AuthLog;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Label84\AuthLog\Subscribers\AuthEventsSubscriber;

class AuthLogServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'authlog');

        $this->publishes([
            __DIR__.'/../database/migrations/create_auth_logs_table.php.stub' => database_path('migrations/'.date('Y_m_d_His_', time()).'create_auth_logs_table.php'),
        ], 'migrations');

        Event::subscribe(AuthEventsSubscriber::class);
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('authlog.php'),
            ], 'config');
        }
    }
}
