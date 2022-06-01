<?php

namespace Database\Seeders;

use App\Entities\Cart;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hasCart = DB::table('carts')->where('user_id', 1)->first();

        if (!$hasCart) {
            Cart::factory(1)->create([
                'user_id' => DB::table('users')->where('id', 1)->first()->id
            ]);
        }
    }
}
