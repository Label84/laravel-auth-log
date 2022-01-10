<?php

namespace Label84\AuthLog\Tests\Custom;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Label84\AuthLog\Listeners\LogAuthAction;
use Label84\AuthLog\Tests\TestCase;

class CustomEventsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_can_add_context_to_the_database_record()
    {
        $event = new \Illuminate\Auth\Events\Login('web', $this->user, false);

        $context = [
            'impersonator_id' => 1000,
            'impersonated_id' => 1001,
        ];

        (new LogAuthAction())->handle($event, $context);

        $this->assertCount(1, DB::table('authentication_logs')
            ->where('event_name', class_basename(\Illuminate\Auth\Events\Login::class))
            ->whereNull('email')
            ->where('user_id', 1000)
            ->where('context', json_encode([
                'impersonator_id' => 1000,
                'impersonated_id' => 1001,
            ]))
            ->get());
    }
}
