<?php

namespace Label84\AuthLog\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Label84\AuthLog\AuthLogServiceProvider;
use Orchestra\Testbench\Factories\UserFactory;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();

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
        config()->set('authlog.database_connection', 'sqlite');
        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);
    }

    protected function setUpDatabase()
    {
        Schema::create(config('authlog.table_name'), function (Blueprint $table) {
            $table->id();

            $table->string('event_name');
            $table->string('email')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('ip_address');
            $table->text('user_agent')->nullable();

            $table->text('context')->nullable();

            $table->datetime('created_at')->useCurrent();
        });
    }
}
