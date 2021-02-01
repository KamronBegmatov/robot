<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreateNewMonitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('create_new_monitors', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('monitor_type');
            $table->string('name');
            $table->string('url');
            $table->char('interval');
            $table->unique(array('user_id', 'name'));
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
        Schema::dropIfExists('create_new_monitors');
    }
}
