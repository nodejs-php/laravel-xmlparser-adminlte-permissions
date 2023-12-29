<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnDelete();
            $table->integer('referenced_id');
            $table->boolean('available');
            $table->string('url');
            $table->float('price');
            $table->float('old_price');
            $table->string('currency_id');
            $table->string('picture');
            $table->string('name');
            $table->string('vendor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
