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
            $table->timestamps();
            $table->string('name');
            $table->longText('description');
            $table->decimal('price')->default('0')->unsigned();
            $table->unsignedInteger('year')->default('0');
            $table->longText('picture')->nullable();
            $table->unsignedBigInteger('quantity')->default('0');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unique(['name', 'category_id']);
            $table->foreign('category_id')->references('id')->on('categories');
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
