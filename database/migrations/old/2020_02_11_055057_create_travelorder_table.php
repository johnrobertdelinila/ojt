<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelorderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travelorder', function (Blueprint $table) {
            $table->increments('id');
            $table->string('travel_id')->nullable();
            $table->string('departure')->nullable();
            $table->string('arrival')->nullable();
            $table->longText('destination')->nullable();
            $table->longText('purpose')->nullable();
            $table->string('per_diems')->nullable();
            $table->string('laborers')->nullable();
            $table->longText('remarks')->nullable();
            $table->longText('involve')->nullable();
            $table->string('requested_by')->nullable();
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->integer('sequence')->nullable();
            $table->string('date_requested')->nullable();
            $table->string('travel_status')->nullable();
            $table->string('signatory_first')->nullable();
            $table->string('signatory_second')->nullable();
            $table->string('routed_to')->nullable();
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
        Schema::dropIfExists('travelorder');
    }
}
