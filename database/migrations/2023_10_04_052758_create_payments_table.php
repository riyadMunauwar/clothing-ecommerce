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
        Schema::create('payments', function (Blueprint $table) {
            $table->id()->startingValue(1000000);
            $table->string('reference')->nullable();
            $table->string('provider')->nullable();
            $table->string('method')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('BDT')->nullable();
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->foreignId('order_id')->constrained();
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
        Schema::dropIfExists('payments');
    }
};
