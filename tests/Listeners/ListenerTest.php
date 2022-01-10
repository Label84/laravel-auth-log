<?php

namespace Label84\AuthLog\Tests\Listeners;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Label84\AuthLog\Tests\TestCase;

class ListenerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_creates_a_database_record_on_attempting_event()
    {
        event(new \Illuminate\Auth\Events\Attempting('web', ['email' => $this->user->email], false));

        $this->assertCount(1, DB::table('authentication_logs')
            ->where('event_name', class_basename(\Illuminate\Auth\Events\Attempting::class))
            ->where('email', 'info@example.org')
            ->whereNull('user_id')
            ->get());
    }

    /** @test */
    public function it_does_not_create_a_database_record_on_authenticated_event()
    {
        event(new \Illuminate\Auth\Events\Authenticated('web', $this->user));

        $this->assertCount(0, DB::table('authentication_logs')
            ->where('event_name', class_basename(\Illuminate\Auth\Events\Authenticated::class))
            ->where('email', 'info@example.org')
            ->where('user_id', $this->user->id)
            ->get());
    }

    /** @test */
    public function it_creates_a_database_record_on_failed_event()
    {
        event(new \Illuminate\Auth\Events\Failed('web', null, ['email' => $this->user->email]));

        $this->assertCount(1, DB::table('authentication_logs')
            ->where('event_name', class_basename(\Illuminate\Auth\Events\Failed::class))
            ->where('email', 'info@example.org')
            ->whereNull('user_id')
            ->get());
    }

    /** @test */
    public function it_creates_a_database_record_on_lockout_event()
    {
        $request = new Request(['email' => $this->user->email]);

        event(new \Illuminate\Auth\Events\Lockout($request));

        $this->assertCount(1, DB::table('authentication_logs')
            ->where('event_name', class_basename(\Illuminate\Auth\Events\Lockout::class))
            ->where('email', 'info@example.org')
            ->get());
    }

    /** @test */
    public function it_creates_a_database_record_on_login_event()
    {
        event(new \Illuminate\Auth\Events\Login('web', $this->user, false));

        $this->assertCount(1, DB::table('authentication_logs')
            ->where('event_name', class_basename(\Illuminate\Auth\Events\Login::class))
            ->whereNull('email')
            ->where('user_id', 1000)
            ->get());
    }

    /** @test */
    public function it_creates_a_database_record_on_logout_event()
    {
        event(new \Illuminate\Auth\Events\Logout('web', $this->user));

        $this->assertCount(1, DB::table('authentication_logs')
            ->where('event_name', class_basename(\Illuminate\Auth\Events\Logout::class))
            ->whereNull('email')
            ->where('user_id', 1000)
            ->get());
    }

    /** @test */
    public function it_creates_a_database_record_on_other_device_logout_event()
    {
        event(new \Illuminate\Auth\Events\OtherDeviceLogout('web', $this->user));

        $this->assertCount(1, DB::table('authentication_logs')
            ->where('event_name', class_basename(\Illuminate\Auth\Events\OtherDeviceLogout::class))
            ->whereNull('email')
            ->where('user_id', 1000)
            ->get());
    }

    /** @test */
    public function it_creates_a_database_record_on_password_reset_event()
    {
        event(new \Illuminate\Auth\Events\PasswordReset($this->user));

        $this->assertCount(1, DB::table('authentication_logs')
            ->where('event_name', class_basename(\Illuminate\Auth\Events\PasswordReset::class))
            ->whereNull('email')
            ->where('user_id', 1000)
            ->get());
    }

    /** @test */
    public function it_creates_a_database_record_on_registered_event()
    {
        event(new \Illuminate\Auth\Events\Registered($this->user));

        $this->assertCount(1, DB::table('authentication_logs')
            ->where('event_name', class_basename(\Illuminate\Auth\Events\Registered::class))
            ->whereNull('email')
            ->where('user_id', 1000)
            ->get());
    }

    /** @test */
    public function it_creates_a_database_record_on_verified_event()
    {
        event(new \Illuminate\Auth\Events\Verified($this->user));

        $this->assertCount(1, DB::table('authentication_logs')
            ->where('event_name', class_basename(\Illuminate\Auth\Events\Verified::class))
            ->whereNull('email')
            ->where('user_id', 1000)
            ->get());
    }
}
