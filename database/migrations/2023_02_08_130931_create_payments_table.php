<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('receiver_id')->unsigned();
            $table->integer('payer_id')->unsigned();
            $table->integer('sale_id')->unsigned()->nullable();
            $table->string('company_id');
            $table->date('date')->nullable();
            $table->string('transaction_mode');
            $table->decimal('amount', 12, 0)->unsigned();
            $table->string('remarks')->nullable();
            $table->timestamps();

            $table->foreign('receiver_id')->references('id')->on('users');
            $table->foreign('payer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}