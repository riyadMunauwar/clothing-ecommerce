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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('meta_title')->nullable();
            $table->string('meta_tags')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->decimal('sale_price', 12, 2)->nullable();
            $table->decimal('regular_price', 12, 2)->nullable();
            $table->decimal('weight', 12, 2)->nullable();
            $table->string('weight_unit')->nullable();
            $table->decimal('height', 12, 2)->nullable();
            $table->decimal('width', 12, 2)->nullable();
            $table->decimal('length', 12, 2)->nullable();
            $table->string('dimension_unit')->nullable();
            $table->integer('stock_qty')->nullable();
            $table->string('sku')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('youtube_video_url', 2048)->nullable();
            $table->string('youtube_video_id')->nullable();
            $table->json('variation_options')->nullable();
            $table->boolean('is_premium')->nullable()->default(false);
            $table->boolean('is_featured')->nullable()->default(false);
            $table->boolean('is_published')->nullable()->default(true);
            $table->boolean('is_grocery')->nullable()->default(false);
            $table->boolean('is_ebnshop_own_product')->nullable()->default(true);
            $table->foreignId('brand_id')->nullable()->constrained();
            $table->string('cache_key')->nullable();
            $table->unsignedBigInteger('views')->nullable()->default(0);
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
        Schema::dropIfExists('products');
    }
};
