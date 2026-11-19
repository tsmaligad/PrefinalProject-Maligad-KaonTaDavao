<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eateries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')->constrained();
            $table->string('name', 100)->unique();
            $table->string('slug')->unique();
            $table->string('address');
            $table->string('price_range');
            $table->string('specialty')->nullable();
            $table->boolean('is_open')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eateries');
    }
};
