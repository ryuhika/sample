<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('orders')->insert([
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'client_id' => 1,
                'product_id' => 21,
                'number' => 5,
                'condition' => 0,
                'user_id' => 1
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'client_id' => 2,
                'product_id' => 22,
                'number' => 8,
                'condition' => 0,
                'user_id' => 2
            ],
        ]);
    }
}
