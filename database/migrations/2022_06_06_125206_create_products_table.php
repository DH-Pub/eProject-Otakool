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
            $table->uuid('id')->primary();
            $table->string('name', 255);
            $table->float('price', 9, 2)->unsigned(true)->nullable();
            $table->text('description')->nullable();
            $table->date('release')->nullable(); // official release date
            $table->integer('quantity')->nullable();
            $table->integer('status')->nullable(); //available/ none

            $table->string('type')->nullable();
            $table->string('tags', 255)->nullable(); // ex: #Bleach#, #Naruto#
            $table->string('cover', 255)->nullable(); // cover image
            $table->text('images')->nullable(); // other images
            $table->string('folder', 255)->nullable(); // store location
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
