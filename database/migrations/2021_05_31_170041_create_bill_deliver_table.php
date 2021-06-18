<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillDeliverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_deliver', function (Blueprint $table) {
            $table->id();
            $table->integer('bill_id');
            $table->string('partner_id');
            $table->string('label');
            $table->integer('area');
            $table->integer('fee');
            $table->integer('insurance_fee');
            $table->string('estimated_pick_time');
            $table->string('estimated_deliver_time');
            $table->string('products');
            $table->string('status_id');
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
        Schema::dropIfExists('bill_deliver');
    }
}
