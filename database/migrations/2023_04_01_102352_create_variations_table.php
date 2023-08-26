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
        Schema::create('variations', function (Blueprint $table) {
            $table->id();
            $table->decimal('sale_price', 12, 2);
            $table->decimal('regular_price', 12, 2)->nullable();
            $table->integer('stock_qty');
            $table->string('sku')->nullable();
            $table->decimal('weight', 12, 2)->nullable();
            $table->string('weight_unit')->nullable();
            $table->decimal('height', 12, 2)->nullable();
            $table->decimal('width', 12, 2)->nullable();
            $table->decimal('length', 12, 2)->nullable();
            $table->string('dimension_unit')->nullable();
            $table->json('options');
            $table->boolean('is_published')->default(true);
            $table->foreignId('product_id')->constrained();
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
        Schema::dropIfExists('variations');
    }
};
