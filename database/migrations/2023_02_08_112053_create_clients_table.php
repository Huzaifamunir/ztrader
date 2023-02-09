<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('company_id')->nullable();
            $table->string('company_name')->nullable();
            $table->string('tax_no')->nullable();
            $table->string('hrb_no')->nullable();
            $table->float('start_bal', 12, 0)->unsigned()->nullable();
            $table->float('current_bal', 12, 0)->nullable()->nullable();
            $table->string('comment')->nullable();
            $table->timestampsTz();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('parent_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}