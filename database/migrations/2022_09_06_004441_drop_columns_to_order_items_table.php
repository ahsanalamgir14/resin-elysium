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
            $table->dropColumn('price');
            $table->dropColumn('qty');
            $table->dropForeign('order_items_product_id_foreign');
            $table->dropIndex('order_items_product_id_foreign');
            $table->dropForeign('order_items_order_id_foreign');
            $table->dropIndex('order_items_order_id_product_id_unique');
            $table->dropColumn('product_id');
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
