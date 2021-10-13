<?php

use App\ProductsWishlist;
use Illuminate\Database\Seeder;

class WishlistProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProductsWishlist::class,10)->create();
    }
}
