<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// use DB;

class CreateOrderStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_status', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->timestamps();
        });
        DB::table('order_status')->insert([
            [ 'id' => '1', 'status' => 'Pending'],
            [ 'id' => '2', 'status' => 'Processing'],
            [ 'id' => '3', 'status' => 'Completed'],
            [ 'id' => '4', 'status' => 'OnHold'],
            [ 'id' => '5', 'status' => 'Rejected']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_status');
    }
}
