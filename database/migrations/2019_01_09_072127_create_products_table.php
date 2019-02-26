<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            // $table->unsignedInteger('user_id');
            $table->unsignedInteger('category_id');
            // $table->unsignedInteger('size_id');
            $table->string('title');
            $table->string('slug')->unique();
            // $table->unsignedInteger('quantity')->default(0);
            $table->float('price')->default(0);
            $table->string('product_image')->nullable();
            $table->text('description');
            $table->unsignedTinyInteger('feature_item')->default(0);
            $table->timestamps();

            // $table->foreign('user_id')->references('id') ->on('users')->onDelete('cascade');
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
