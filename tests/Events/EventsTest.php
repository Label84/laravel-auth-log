<?php

namespace Label84\AuthLog\Tests\Events;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Label84\AuthLog\Listeners\LogAuthAction;
use Label84\AuthLog\Tests\TestCase;

class EventsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_triggers_log_auth_action_on_attempting_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new \Illuminate\Auth\Events\Attempting('web', [], false));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }

    /** @test */
    public function it_triggers_log_auth_action_on_authenticated_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new \Illuminate\Auth\Events\Authenticated('web', []));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }

    /** @test */
    public function it_triggers_log_auth_action_on_failed_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new \Illuminate\Auth\Events\Failed('web', null, []));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }

    /** @test */
    public function it_triggers_log_auth_action_on_lockout_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new \Illuminate\Auth\Events\Lockout(new Request([])));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }

    /** @test */
    public function it_triggers_log_auth_action_on_login_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new \Illuminate\Auth\Events\Login('web', $this->user, false));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }

    /** @test */
    public function it_triggers_log_auth_action_on_logout_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new \Illuminate\Auth\Events\Logout('web', $this->user));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }

    /** @test */
    public function it_triggers_log_auth_action_on_other_device_logout_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new \Illuminate\Auth\Events\OtherDeviceLogout('web', $this->user));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }

    /** @test */
    public function it_triggers_log_auth_action_on_password_reset_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new \Illuminate\Auth\Events\PasswordReset($this->user));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }

    /** @test */
    public function it_triggers_log_auth_action_on_registered_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new \Illuminate\Auth\Events\Registered($this->user));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }

    /** @test */
    public function it_triggers_log_auth_action_on_verified_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new \Illuminate\Auth\Events\Verified($this->user));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }
}
