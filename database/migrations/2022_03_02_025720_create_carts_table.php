<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->float('discount_amount')->nullable();
            $table->unsignedInteger('items_count')->nullable()->default(0);
            $table->unsignedInteger('items_qty')->nullable()->default(0);
            $table->float('sub_total')->nullable()->default(0);
            $table->float('total')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->unique('user_id');
        });

        Schema::create('cart_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->string('sku');
            $table->string('name');
            $table->unsignedInteger('cart_id');
            $table->unsignedInteger('qty');
            $table->float('base_price');
            $table->float('discount_amount')->nullable()->default(0);
            $table->float('sub_total');
            $table->float('total');

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('cart_id')->references('id')->on('carts')
                ->onDelete('cascade');

            $table->unique(['product_id', 'cart_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
