<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_times', function (Blueprint $table) {
            $table->increments('id');
            $table->string('time_show', 10);
            $table->string('type_ticket', 20);
            $table->integer('calendar_id')->unsigned();
            $table->foreign('calendar_id')->references('id')->on('calendars');
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
        Schema::dropIfExists('calendar_times');
    }
}
