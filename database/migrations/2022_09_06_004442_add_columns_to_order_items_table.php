<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {

            $table->after('order_quote_id', function ($table) {
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
                $table->softDeletes();
            });
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('order_quote_id')->references('id')->on('order_quotes')->onDelete('cascade');
            $table->unique(['order_id']);
            $table->unique(['order_id', 'SKU', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            //
        });
    }
};
