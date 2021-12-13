<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('order_id');
          $table->unsignedBigInteger('product_id');
          $table->double('item_price');
          $table->integer('item_quantity');
          $table->double('item_total_price');
          $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('order_items');
    }
}
