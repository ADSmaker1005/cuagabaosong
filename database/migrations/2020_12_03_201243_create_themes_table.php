<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('_token')->nullable();
            $table->string('_method')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('keywords')->nullable();
            $table->integer('hotline')->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->longText('schema')->nullable();
            $table->longText('headtag')->nullable();
            $table->integer('zalo')->nullable();
            $table->string('fanpage')->nullable();
            $table->longText('css')->nullable();
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
        Schema::dropIfExists('themes');
    }
}
