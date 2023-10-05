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
            $table->string('order_no', 32)->unique();

            $table->decimal('total_price', 10, 2);
            $table->decimal('shipping_price', 10, 2)->default(0);

            $table->string('admin_notes', 2048)->nullable();
            $table->string('customer_notes', 2048)->nullable();

            $table->foreignId('user_id')->constrained();
            $table->foreignId('admin_id')->nullalbe()->constrained('users', 'id');
            $table->foreignId('address_id')->constrained();

            $table->string('shipping_option')->nullable();
            $table->string('payment_option');
            $table->enum('order_status', ['new', 'processing', 'shipped', 'delivered', 'cancelled'])->default('new');
            $table->enum('payment_status', ['paid', 'unpaid', 'partially-paid'])->default('unpaid');

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
