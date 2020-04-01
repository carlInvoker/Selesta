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
            $table->bigIncrements('product_id');
            $table->string('product_name', 255);
            $table->text('product_description');
            $table->double('product_price', 8, 2)->nullable();
            $table->string('product_image', 1024)->nullable();
            $table->integer('product_status',2)->default(1);
            $table->string('product_category', 255)->nullable();
            $table->string('title', 128);
            $table->string('metaDescription', 160);
            $table->string('metaKeywords', 160);
            $table->timestamps();
        });
    }
  $table->integer('sliders_status',2)->default(1);
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
