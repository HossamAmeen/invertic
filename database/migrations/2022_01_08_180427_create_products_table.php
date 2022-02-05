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
            $table->string('name'); 
            $table->string('en_name'); 
            $table->string('image');
            $table->double('price');
            $table->string('color');
            $table->string('type');
            $table->string('description');
            $table->integer('order_item')->nullable(); 
            
            $table->string('capacity')->nullable();
            $table->string('control')->nullable();
            $table->string('technology')->nullable();
            $table->string('micanthim')->nullable();
            $table->string('shape')->nullable();
            $table->string('characteristic')->nullable();
            $table->string('guarantee')->nullable();
            $table->string('energy_efficiency')->nullable();

            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');

            $table->bigInteger('module_id')->unsigned()->nullable();
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes();
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
