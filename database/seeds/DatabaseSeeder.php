<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeedsr::class);
        //  $this->call(MaincategorySeeder::class);
        //  $this->call(SubCategoryseeder::class);
        //  $this->call(VendorSeeder::class);
        // $this->call(ProductSeeder::class);
        //  $this->call(BrandsSeeder::class);
        // $this->call(StoreSeeder::class);
          //  $this->call(StoreProductsSeeder::class);
            // $this->call(OrdersSeeder::class);
        //  $this->call(OrdersProductsSeeder::class);
        //  $this->call(WishlistSeeder::class);
        $this->call(WishlistProductSeeder::class);


    }
}
