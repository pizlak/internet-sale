<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
   public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->timestamps();
        });

        DB::table('categories')->insert([
            ['title' => 'Машины', 'slug' => 'auto'],
            ['title' => 'Мотоциклы', 'slug' => 'bike'],
            ['title' => 'Хлеб', 'slug' => 'broad'],
            ['title' => 'Одежда', 'slug' => 'cloth']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
