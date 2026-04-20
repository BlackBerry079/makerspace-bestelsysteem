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
         Schema::create('printer', function (Blueprint $table) {
             // 3D printers in de makerspace
             $table->id(); // Unieke ID
             $table->string('name'); // Printernaam
             $table->text('description')->nullable(); // Beschrijving
             $table->integer('filament_max'); // Maximum filament in gram
             $table->enum('status', ['beschikbaar', 'onderhoud', 'in gebruik'])->default('beschikbaar'); // Status van de printer
             $table->timestamps(); // Created at en Updated at
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('printer');
    }
};