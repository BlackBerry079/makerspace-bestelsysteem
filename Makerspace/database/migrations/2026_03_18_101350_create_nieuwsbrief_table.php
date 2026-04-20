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
         Schema::create('nieuwsbrief', function (Blueprint $table) {
             // Nieuwsbrief berichten voor gebruikers
             $table->id(); // Unieke ID
             $table->string('title'); // Titel van het bericht
             $table->text('description'); // Inhoud van het bericht
             $table->enum('type', ['announcement', 'stock', 'error', 'info']); // Type bericht
             $table->unsignedBigInteger('filament_id')->nullable()->index(); // FK naar filament tabel (optioneel)
             $table->timestamps(); // Created at en Updated at

             // FK: Optioneel gekoppeld aan een specifiek filament (bijv. bij stock berichten)
             $table->foreign('filament_id')->references('id')->on('filament')->onDelete('cascade');
            });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
     Schema::dropIfExists('nieuwsbrief');
    }
};