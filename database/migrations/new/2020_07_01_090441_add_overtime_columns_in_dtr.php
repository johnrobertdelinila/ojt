<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOvertimeColumnsInDtr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dtr', function (Blueprint $table) {
            $table->string('time6')->after('time4')->nullable();
            $table->string('time5')->after('time4')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dtr', function (Blueprint $table) {
            $table->dropColumn('time6');
            $table->dropColumn('time5');
        });
    }
}
