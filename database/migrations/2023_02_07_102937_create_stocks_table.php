<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('stocks', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->unsignedBigInteger('user_id');
            $table->integer('provider_id')->unsigned();
            $table->decimal('total_sets', 8, 0)->unsigned();
            $table->decimal('total_amount', 12, 0)->unsigned();
            $table->timestampsTz();
 
            $table->foreign('user_id')->references('id')->on('users');

         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
