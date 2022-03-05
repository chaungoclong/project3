<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('sku')->unique();
            $table->string('type');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('attribute_set_id')->nullable();
            $table->timestamps();

            // foreign key
            $table->foreign('category_id')->references('id')
                ->on('categories');
            $table->foreign('attribute_set_id')->references('id')
                ->on('attribute_sets');
        });

        Schema::table('products', function(Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('products');
        });

        Schema::create('product_relations', function (Blueprint $table) {
            $table->unsignedInteger('parent_id');
            $table->unsignedInteger('child_id');

            $table->foreign('parent_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('child_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_super_attributes', function (Blueprint $table) {
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('attribute_id');

            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('attributes');
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade');
        });

        Schema::create('product_inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qty')->default(0);
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('supplier_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')
                ->onDelete('cascade');
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
        Schema::dropIfExists('product_relations');
        Schema::dropIfExists('product_super_attributes');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('product_inventories');
    }
}
