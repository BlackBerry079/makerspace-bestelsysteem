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
         Schema::create('filament_category', function (Blueprint $table) {
             // Categorieën voor filament (PLA, ABS, PETG, etc.)
             $table->id(); // Unieke ID
             $table->string('name'); // Categorienaam
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    //  Schema::dropIfExists('order');
     Schema::dropIfExists('filament_category');
    }
};