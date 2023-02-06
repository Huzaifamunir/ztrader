<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('company_id')->nullable();
            $table->unsignedBigInteger('sub_category_id');
            $table->string('name')->nullable();
            $table->string('model')->nullable();
            $table->decimal('purchase_price', 12, 0)->nullable();
            $table->decimal('sale_price', 12, 0)->nullable();
            $table->decimal('current_stock', 12, 0)->nullable();
            $table->decimal('min_stock_value', 12, 0)->nullable();
            $table->string('image')->nullable();
            $table->string('comment')->nullable();
            $table->timestampsTz();
            $table->softDeletes();

            $table->foreign('sub_category_id')->references('id')->on('sub_categories');
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
