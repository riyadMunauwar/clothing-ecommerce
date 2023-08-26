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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->dateTime('order_date')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->decimal('total_product_price', 12, 2);
            $table->decimal('shipping_cost', 12, 2)->nullable();
            $table->decimal('total_vat', 12, 2)->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('admin_id')->nullalbe()->constrained('users', 'id');
            $table->string('coupon_id')->nullable();
            $table->string('shipper_id')->nullable();
            $table->string('shippo_address_object_id')->nullable();
            $table->string('lebel_url', 2048)->nullable();
            $table->string('tracking_url', 2048)->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('parcel_id')->nullable();
            $table->string('parcel_width')->nullable();
            $table->string('parcel_height')->nullable();
            $table->string('parcel_length')->nullable();
            $table->string('parcel_wieght')->nullable();
            $table->string('rate_object_id')->nullable();
            $table->string('payment_method_id')->nullable();
            $table->string('order_status_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
