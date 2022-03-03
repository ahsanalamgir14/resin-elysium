<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;

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
            $table->unsignedBigInteger('category_id'); //many to one
            $table->unsignedBigInteger('discount_id')->nullable()->default(null); //many to one
            $table->string('name');
            $table->string('slug');
            $table->string('type');
            $table->string('SKU');
            $table->decimal('price');
            $table->longText('desc');
            $table->Integer('qty');
            $table->longText('main_image')->nullable()->default(null);
            $table->longText('3d_model')->nullable()->default(null);
            $table->longText('images')->nullable()->default(null);
            $table->integer('status');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->softDeletes();
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
