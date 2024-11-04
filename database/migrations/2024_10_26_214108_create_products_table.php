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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->float('price');
            $table->integer('count');
            $table->unsignedBigInteger('user_id')->index('product_user_idx');
            $table->unsignedBigInteger('category_id')->index('product_category_idx');
            $table->timestamps();

            $table->foreign('user_id', 'product_user_fk')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('category_id', 'product_category_fk')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
