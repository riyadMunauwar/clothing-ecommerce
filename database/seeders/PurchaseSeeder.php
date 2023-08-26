<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;
use Faker\Factory as Faker;




class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        
        $rowQty = 5000;

        while($rowQty){

            $product = Product::inRandomOrder()->first();
            $supplier = Supplier::inRandomOrder()->first();

            $purchase = new Purchase();

            $purchase->price = $faker->numberBetween($min = 1, $max = 1000);
            $purchase->qty = $faker->numberBetween($min = 1, $max = 2000);
            $purchase->piad_to_supplier = $faker->numberBetween($min = 1, $max = 500);
            $purchase->product_id = $product->id;
            $purchase->supplier_id = $supplier->id;

            $purchase->save();

            $rowQty--;
        }
    }
}
