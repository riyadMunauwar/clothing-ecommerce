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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 12, 2);
            $table->unsignedBigInteger('qty');
            $table->decimal('paid_to_supplier', 12, 2)->nullable();
            $table->foreignId('product_id')->constraind();
            $table->foreignId('variation_id')->nullable()->constraind();
            $table->foreignId('supplier_id')->nullable()->constraind();
            $table->string('cache_key')->nullable();
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
        Schema::dropIfExists('purchases');
    }
};
