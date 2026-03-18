<?php

namespace Label84\AuthLog\Tests\Events;

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
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Label84\AuthLog\Listeners\LogAuthAction;
use Label84\AuthLog\Tests\TestCase;

class EventsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_it_triggers_log_auth_action_on_registered_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new Registered($this->user));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }

    public function test_it_triggers_log_auth_action_on_attempting_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new Attempting('web', [], false));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }

    public function test_it_triggers_log_auth_action_on_authenticated_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new Authenticated('web', []));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }

    public function test_it_triggers_log_auth_action_on_login_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new Login('web', $this->user, false));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }

    public function test_it_triggers_log_auth_action_on_failed_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new Failed('web', null, []));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }

    public function test_it_triggers_log_auth_action_on_validated_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new Validated('web', $this->user));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }

    public function test_it_triggers_log_auth_action_on_verified_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new Verified($this->user));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }

    public function test_it_triggers_log_auth_action_on_logout_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new Logout('web', $this->user));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }

    public function test_it_triggers_log_auth_action_on_current_device_logout_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new CurrentDeviceLogout('web', $this->user));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }

    public function test_it_triggers_log_auth_action_on_other_device_logout_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new OtherDeviceLogout('web', $this->user));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }

    public function test_it_triggers_log_auth_action_on_lockout_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new Lockout(new Request([])));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }

    public function test_it_triggers_log_auth_action_on_password_reset_event()
    {
        $logAuthAction = $this->spy(LogAuthAction::class);

        event(new PasswordReset($this->user));

        $logAuthAction->shouldHaveReceived('handle')->once();
    }
}
