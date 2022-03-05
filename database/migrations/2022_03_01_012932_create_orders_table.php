<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('type');
            $table->boolean('status');
            $table->unsignedInteger('shipping_method_id')->nullable();
            $table->string('shipping_method_name')->nullable();
            $table->float('shipping_amount')->nullable();
            $table->float('discount_amount')->nullable();
            $table->unsignedInteger('items_count')->nullable()->default(0);
            $table->unsignedInteger('items_qty')->nullable()->default(0);
            $table->float('sub_total')->nullable()->default(0);
            $table->float('total')->nullable()->default(0);
            $table->string('note')->nullable()->default('');
            $table->unsignedInteger('supplier_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('shipping_method_id')->references('id')
                ->on('shipping_methods');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->string('sku');
            $table->string('name');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('qty');
            $table->float('base_price');
            $table->float('discount_amount')->nullable()->default(0);
            $table->float('sub_total');
            $table->float('total');

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('order_id')->references('id')->on('orders')
                ->onDelete('cascade');

            $table->unique(['product_id', 'order_id']);
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
        Schema::dropIfExists('order_items');
    }
}
