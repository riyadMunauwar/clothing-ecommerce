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
        Schema::create('settings', function (Blueprint $table) {
            
            $table->id();
            $table->string('meta_title', 1048)->nullable();
            $table->string('meta_tags', 1048)->nullable();
            $table->string('meta_description', 2048)->nullable();

            $table->string('website_name')->nullable();
            $table->string('website_email')->nullable();
            $table->string('website_phone')->nullable();

            $table->string('address', 2048)->nullable();

            $table->string('top_header_message_text', 1048)->nullable();
            $table->string('top_header_message_text_link', 1048)->nullable();
            $table->string('top_header_button_text')->nullable();
            $table->string('top_header_button_text_link', 1024)->nullable();

            $table->boolean('is_top_header_active')->default(false)->nullable();
            $table->boolean('is_footer_active')->default(false)->nullable();
            $table->boolean('is_selling_featre_banner_active')->default(false)->nullable();

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
        Schema::dropIfExists('settings');
    }
};
