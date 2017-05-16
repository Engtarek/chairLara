<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductLayerImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_layer_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->string('color');
            $table->string('item_name');
            $table->string('item_distributer_name');
            $table->string('item_price');
            $table->integer('product_layers_id')->unsigned();
            $table->foreign('product_layers_id')->references('id')->on('product_layers');
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
        Schema::dropIfExists('product_layer_images');
    }
}
