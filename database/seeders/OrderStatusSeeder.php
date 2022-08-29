<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('order_status')->truncate();
        DB::table('order_status')->Insert([
            [ 'id' => '1', 'status' => 'Pending'],
            [ 'id' => '2', 'status' => 'Approved'],
            [ 'id' => '3', 'status' => 'Processing'],
            [ 'id' => '4', 'status' => 'Completed'],
            [ 'id' => '5', 'status' => 'OnHold'],
            [ 'id' => '6', 'status' => 'Rejected'],
            [ 'id' => '7', 'status' => 'Declined']
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
