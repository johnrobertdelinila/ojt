<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('par', function (Blueprint $table) {
            $table->increments('id');
            $table->string('par_name')->nullable();
            $table->string('par_details')->nullable();
            $table->string('par_level')->nullable();
            $table->string('inv_tracer')->nullable();
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
        Schema::dropIfExists('par');
    }
}
