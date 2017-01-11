<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_language', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->string('language_id', 5);
            $table->string('title');
            $table->string('description');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('language_id')->references('id')->on('language');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_language', function (Blueprint $table) {
            //
        });
    }
}
