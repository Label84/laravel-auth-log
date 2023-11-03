<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthLogsTable extends Migration
{
    public function up()
    {
        Schema::connection(config('authlog.database_connection'))->create(config('authlog.table_name'), function (Blueprint $table) {
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

    public function down()
    {
        Schema::connection(config('authlog.database_connection'))->dropIfExists(config('authlog.table_name'));
    }
}
