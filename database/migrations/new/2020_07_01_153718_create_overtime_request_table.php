<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOvertimeRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overtime_request', function (Blueprint $table) {
            $table->increments('id');
            $table->string('overtime_requestor')->nullable();
            $table->string('overtime_start_date')->nullable();
            $table->string('overtime_end_date')->nullable();
            $table->longText('overtime_purpose')->nullable();
            $table->longText('overtime_supporting_document')->nullable();
            $table->string('overtime_status')->nullable();
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
        Schema::dropIfExists('overtime_request');
    }
}
