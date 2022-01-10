<?php

namespace Label84\AuthLog;

use Illuminate\Support\ServiceProvider;
use Label84\AuthLog\Providers\EventServiceProvider;

class AuthLogServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'authlog');

        $this->publishes([
            __DIR__.'/../database/migrations/create_auth_logs_table.php.stub' => database_path('migrations/'.date('Y_m_d_His_', time()).'create_auth_logs_table.php'),
        ], 'migrations');

        $this->app->register(EventServiceProvider::class);
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
