<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('filament', function (Blueprint $table) {
        // Beschikbare filament voor 3D printing
        $table->id(); // Unieke ID
        $table->string("name"); // Filametnaam
        $table->text("description"); // Beschrijving
        $table->integer("amount"); // Hoeveelheid beschikbaar in gram
        $table->boolean('active'); // Actief/inactief
        $table->unsignedBigInteger("category_id")->index(); // FK naar filament_category tabel
        $table->timestamps(); // Created at en Updated at
        
        // FK: Tot welke categorie (PLA, ABS, PETG, etc.) behoort dit filament
        $table->foreign('category_id')->references('id')->on('filament_category')->onDelete('cascade');
    });
}

    public function down(): void
    {
        Schema::dropIfExists('filament');
    }
};