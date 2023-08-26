<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $rowQty = 10000;

        while($rowQty){

            $user = User::inRandomOrder()->first();
            $admin = User::inRandomOrder()->first();

            $order = new Order();

            $order->order_date = $faker->dateTimeBetween($startDate = '2022-01-01', $endDate = '2023-12-31')->format('Y-m-d H:i:s');
            $order->paid_at = $faker->dateTimeBetween($startDate = '2022-01-01', $endDate = '2023-12-31')->format('Y-m-d H:i:s');
            $order->total_product_price = $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 10000);
            $order->shipping_cost = $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 100);
            $order->user_id = $user->id;
            $order->admin_id = $admin->id;
            $order->total_vat = $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 1000);

            $order->save();

            $orederItemQty = $faker->numberBetween($min = 1, $max = 20);

            while($orederItemQty){

                $product = Product::inRandomOrder()->first();

                $orderItem = new OrderItem();

                $orderItem->price = $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 10000);
                $orderItem->qty = $faker->numberBetween($min = 1, $max = 10);
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $product->id;

                $orderItem->save();

                $orederItemQty--;
            }

            $rowQty--;
        }
    }

}
