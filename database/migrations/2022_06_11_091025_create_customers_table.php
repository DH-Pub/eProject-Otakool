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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name',100);
            $table->string('email',100)->unique();
            $table->string('tel',20)->nullable();
            $table->string('address',255)->nullable();
            $table->tinyInteger('status')->default(1)->comment('0=Disable, 1=Active');
            $table->string('username',64)->unique();
            $table->string('password',128);
            $table->rememberToken();
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
        Schema::dropIfExists('customers');
    }
};
