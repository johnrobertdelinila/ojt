<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->increments('id');
            //for dropping center
            $table->longText('qrcode')->nullable();
            $table->longText('seller_id')->nullable();
            $table->longText('buyer_name')->nullable();
            $table->longText('item_amount')->nullable();
            $table->longText('item_remarks')->nullable();
            $table->longText('item_status')->nullable();
            $table->longText('item_bookmark')->nullable();
            $table->longText('date_actioned')->nullable();
            $table->longText('date_created')->nullable();
            //emb only
            $table->string('inv_name')->nullable();
            $table->string('inv_prop_no')->nullable();
            $table->integer('inv_ctr')->nullable();
            $table->string('inv_yr')->nullable();
            $table->text('inv_desc')->nullable();
            $table->string('inv_date_acq')->nullable();
            $table->string('inv_serial')->nullable();
            $table->string('inv_locator')->nullable();
            $table->string('inv_unit_value')->nullable();
            $table->string('inv_total_value')->nullable();
            $table->string('inv_netbook_value')->nullable();
            $table->string('inv_remarks')->nullable();
            $table->string('inv_mr')->nullable();
            $table->string('inv_extra1')->nullable();
            $table->string('inv_extra2')->nullable();
            $table->string('inv_extra3')->nullable();
            $table->string('inv_extra4')->nullable();
            $table->string('inv_extra5')->nullable();
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
        Schema::dropIfExists('inventory');
    }
}
