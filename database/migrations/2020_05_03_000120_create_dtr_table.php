<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDtrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtr', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('date')->nullable();
            $table->string('time1')->nullable();
            $table->string('time2')->nullable();
            $table->string('time3')->nullable();
            $table->string('time4')->nullable();
            $table->longText('accomplishment')->nullable();
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
        Schema::dropIfExists('dtr');
    }
}
