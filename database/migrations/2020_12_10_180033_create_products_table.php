<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('keywords')->nullable();
            $table->integer('locate')->default(0)->nullable();
            $table->boolean('showindex')->default(0)->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('img')->nullable();
            $table->string('banner')->nullable();
            $table->integer('oldprice')->default(0)->nullable();
            $table->integer('newprice')->default(0)->nullable();
            $table->string('text')->nullable();
            $table->longText('infoname')->nullable();
            $table->longText('infotext')->nullable();
            $table->longText('content')->nullable();
            
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
        Schema::dropIfExists('products');
    }
}
