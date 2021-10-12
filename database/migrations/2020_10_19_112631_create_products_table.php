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
              $table->id();
            $table->integer('category_id');
            $table->integer('section_id');
            $table->string('product_name');
            $table->float('product_discount');
            $table->string('product_code');
            $table->string('product_color');
            $table->float('product_price')->nullable();
            $table->float('product_weight')->nullable();;
            $table->string('product_video')->nullable();;
            $table->text('product_description')->nullable();;
            $table->string('product_main_image')->nullable();;
            $table->string('product_wash_care')->nullable();;
            $table->string('product_fabric')->nullable();;
            $table->string('product_pattern')->nullable();;
            $table->string('product_sleeve')->nullable();;
            $table->string('product_fit')->nullable();;
            $table->string('product_occassion')->nullable();
            $table->string('product_meta_title')->nullable();;
            $table->string('product_meta_description')->nullable();;
            $table->string('product_meta_keywords')->nullable();;
            $table->enum('product_is_featured', ['Yes', 'No']);
            $table->tinyInteger('status')->nullable();;
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
        Schema::dropIfExists('products');
    }
}
