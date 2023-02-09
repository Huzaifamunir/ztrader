<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('seller_id')->unsigned();
            $table->integer('payment_id')->unsigned();
            $table->string('company_id');
            $table->integer('total_sets');
            $table->decimal('total_amount', 12, 0)->unsigned();
            $table->decimal('total_profit', 12, 0)->nullable()->unsigned();
            $table->decimal('client_balance', 12, 0)->nullable()->unsigned();
            $table->timestampsTz();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('seller_id')->references('id')->on('users');
            $table->foreign('payment_id')->references('id')->on('payments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}