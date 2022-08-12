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
        Schema::create('comments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title',64)->nullable();
            $table->timestamps();
            $table->float('rate',3);
            $table->string('images',510)->nullable();
            $table->string('content',510)->nullable();

            $table->string('p_id');
            $table->foreign('p_id')->references('id')->on('products');
            $table->string('cust_id');
            $table->foreign('cust_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
