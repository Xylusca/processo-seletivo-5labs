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
            $table->foreignId('vendor_id')->constrained('users');
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->decimal('discount_percentage', 5, 2)->nullable();
            $table->decimal('rating', 3, 2)->nullable();
            $table->integer('stock')->nullable();
            $table->string('brand')->nullable();
            $table->string('category');
            $table->string('thumbnail');
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
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
