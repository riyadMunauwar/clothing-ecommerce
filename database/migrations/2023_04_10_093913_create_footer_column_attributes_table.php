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
        Schema::create('footer_column_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('link', 3200)->nullable();
            $table->boolean('is_published')->nullable()->default(true);
            $table->foreignId('footer_column_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('footer_column_attributes');
    }
};
