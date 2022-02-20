<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAndProductTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->unique();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku', 100)->unique();
            $table->unsignedInteger('product_type_id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('category_id');
            $table->string('short_description');
            $table->float('price');
            $table->float('special_price');
            $table->date('special_price_from')->nullable();
            $table->date('special_price_to')->nullable();
            $table->float('height');
            $table->float('width');
            $table->float('long');
            $table->float('weight');
            $table->unsignedInteger('unit_id');
            $table->boolean('is_in_stock')->nullable()->default(false);
            $table->boolean('is_featured')->nullable()->default(false);
            $table->boolean('is_visible')->nullable()->default(false);
            $table->boolean('is_new')->nullable()->default(false);
            $table->boolean('status')->nullable()->default(false);
            $table->text('description');
            $table->timestamps();

            $table->foreign('product_type_id')->references('id')
                ->on('product_types');
            $table->foreign('category_id')->references('id')
                ->on('categories');
            $table->foreign('unit_id')->references('id')
                ->on('units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_types');
        Schema::dropIfExists('products');

    }
}
