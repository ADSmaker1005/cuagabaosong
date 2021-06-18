<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGhtkDeliverSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ghtk_deliver_setting', function (Blueprint $table) {
            $table->id();
            $table->string('_token')->nullable();
            $table->string('_method')->nullable();
            $table->string('pick_name')->nullable();
            $table->string('pick_address')->nullable();
            $table->string('pick_tel')->nullable();
            $table->string('pick_province')->nullable();
            $table->string('pick_district')->nullable();
            $table->string('pick_ward')->nullable();
            $table->string('pick_street')->nullable();
            $table->boolean('use_return_address')->default('0')->nullable();
            $table->string('return_name')->nullable();
            $table->string('return_address')->nullable();
            $table->string('return_tel')->nullable();
            $table->string('return_province')->nullable();
            $table->string('return_district')->nullable();
            $table->string('return_ward')->nullable();
            $table->string('return_street')->nullable();
            $table->string('return_email')->nullable();
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
        Schema::dropIfExists('ghtk_deliver_setting');
    }
}
