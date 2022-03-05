<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->string('type');
            $table->string('validation')->nullable();
            $table->boolean('is_required')->default(0);
            $table->boolean('is_unique')->default(0);
            $table->boolean('is_configurable')->default(0);
            $table->boolean('is_user_defined')->default(1);
            $table->boolean('is_filterable')->default(false);
            $table->boolean('is_visible_on_front')->default(0);
            $table->timestamps();
        });

        Schema::create('attribute_options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('attribute_id');
            $table->string('value');
            $table->timestamps();

            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
        });

        Schema::create('attribute_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->boolean('is_user_defined')->default(true);
            $table->timestamps();
        });

        Schema::create('attribute_sets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->boolean('is_user_defined')->default(true);
            $table->timestamps();
        });

        Schema::create('attribute_group_mappings', function (Blueprint $table) {
            $table->unsignedInteger('attribute_group_id');
            $table->unsignedInteger('attribute_id');

            $table->foreign('attribute_group_id')->references('id')
                ->on('attribute_groups')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')
                ->on('attributes')->onDelete('cascade');
        });

        Schema::create('attribute_set_mappings', 
            function (Blueprint $table) {
            $table->unsignedInteger('attribute_set_id');
            $table->unsignedInteger('attribute_group_id');

            $table->foreign('attribute_set_id')->references('id')
                ->on('attribute_sets')->onDelete('cascade');
            $table->foreign('attribute_group_id')->references('id')
                ->on('attribute_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('attribute_groups');
        Schema::dropIfExists('attribute_options');
        Schema::dropIfExists('attribute_group_attributes');
        Schema::dropIfExists('attribute_sets');
        Schema::dropIfExists('attribute_set_attribute_groups');
    }
}
