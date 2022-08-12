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
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('quantity')->default(0);
            $table->float('price', 9, 2)->unsigned()->default(0);

            $table->string('p_id');
            $table->foreign('p_id')->references('id')->on('products');
            $table->string('o_id');
            $table->foreign('o_id')->references('id')->on('orders');

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
        Schema::dropIfExists('orderdetails');
    }
};
