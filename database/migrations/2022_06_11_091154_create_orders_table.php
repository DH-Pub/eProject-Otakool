<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->float('price', 9, 2)->unsigned()->nullable();
            $table->string('note', 255)->nullable();
            $table->string('status', 30)->default('cart');
            //cart->pending->processing->delivered

            $table->string('cust_id');
            $table->foreign('cust_id')->references('id')->on('customers');

            $table->string('address', 255)->nullable();
            $table->string('contact', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
