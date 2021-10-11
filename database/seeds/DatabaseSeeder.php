<?php

use App\Models\Store;
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
        // $this->call(UserSeeder::class);
        //  $this->call(MaincategorySeeder::class);
        //  $this->call(SubCategoryseeder::class);
        //  $this->call(VendorSeeder::class);
        // $this->call(ProductSeeder::class);
        //  $this->call(BrandsSeeder::class);
        // $this->call(StoreSeeder::class);
            $this->call(StoreProductsSeeder::class);

    }
}
