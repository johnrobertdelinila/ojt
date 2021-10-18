<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('name')->nullable();
            $table->longText('company')->nullable();
            $table->longText('department')->nullable();
            $table->longText('address')->nullable();
            $table->integer('jobskill')->nullable();
            $table->integer('quality')->nullable();
            $table->integer('service')->nullable();
            $table->integer('judgment')->nullable();
            $table->integer('adaptability')->nullable();
            $table->integer('communication')->nullable();
            $table->integer('attendance')->nullable();
            $table->integer('safety')->nullable();
            $table->integer('gala')->nullable();
            $table->longText('placed')->nullable();
            $table->longText('qualification')->nullable();
            $table->longText('weakness')->nullable();
            $table->longText('supervisor')->nullable();
            $table->longText('date')->nullable();
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
        Schema::dropIfExists('evaluation');
    }
}
