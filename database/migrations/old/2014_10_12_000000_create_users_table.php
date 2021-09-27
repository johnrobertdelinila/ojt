<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('users', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('name');
        //     $table->string('email')->unique();
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->string('password');
        //     $table->rememberToken();
        //     $table->string('utype')->nullable();
        //     $table->timestamps();
        // });
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_id');
            $table->string('name');
            $table->string('position');
            $table->string('agency')->nullable();
            $table->string('signature')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('utype')->nullable();
            $table->string('status')->nullable();
            $table->string('rights')->nullable();
            $table->string('image_photo')->nullable();
            $table->string('gender')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
