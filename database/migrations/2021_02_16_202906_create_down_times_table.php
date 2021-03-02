<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('down_times', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('monitor_id')->unsigned();
            $table->foreign('monitor_id')->references('id')->on('monitors');
            $table->string('status', 4);
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
        Schema::dropIfExists('down_times');
    }
}
