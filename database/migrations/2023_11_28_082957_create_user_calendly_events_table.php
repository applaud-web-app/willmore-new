<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCalendlyEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_calendly_events', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('calendly_uri',255)->nullable();
            $table->text('event_guests')->nullable();
            $table->string('event_name',255);
            $table->string('event_type',255);
            $table->string('join_url',255)->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_calendly_events');
    }
}
