<?php

namespace Label84\AuthLog\Tests;

use Label84\AuthLog\AuthLogServiceProvider;
use Orchestra\Testbench\Factories\UserFactory;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->user = (new UserFactory())->make([
            'id' => 1000,
            'email' => 'info@example.org',
        ]);
    }

    protected function getPackageProviders($app): array
    {
        return [
            AuthLogServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        include_once __DIR__.'/../database/migrations/create_auth_logs_table.php.stub';

        (new \CreateAuthLogsTable())->up();
    }
}
