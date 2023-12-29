<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories_offers', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('parent_id')->nullable();
            $table->string('category_name');
            $table->string('offer_id');
            $table->boolean('available');
            $table->string('url')->nullable();
            $table->float('price')->nullable();
            $table->float('old_price')->nullable();
            $table->string('currency_id');
            $table->string('picture')->nullable();
            $table->string('offer_name');
            $table->string('vendor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories_offers');
    }
};
