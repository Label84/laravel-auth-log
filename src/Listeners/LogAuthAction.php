<?php

namespace Label84\AuthLog\Listeners;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class LogAuthAction
{
    /** @param mixed $event */
    public function handle($event): void
    {
        if (config('authlog.enabled') == false) {
            return;
        }

        if (!in_array(get_class($event), config('authlog.events'))) {
            return;
        }

        DB::connection(config('authlog.database_connection'))->table(config('authlog.table_name'))->insert([
            'event_name' => class_basename($event),
            'email' => $this->getEmailParameter($event),
            'user_id' => isset($event->user) ? $event->user->id : null,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    /** @param mixed $event */
    private function getEmailParameter($event): ?string
    {
        if (isset($event->credentials)) {
            return $event->credentials['email'] ?? null;
        }

        if (isset($event->request) && $event->request->has('email')) {
            return $event->request->email;
        }

        return null;
    }
}
