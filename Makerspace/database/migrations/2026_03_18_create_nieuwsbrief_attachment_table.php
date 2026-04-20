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
         Schema::create('nieuwsbrief_attachment', function (Blueprint $table) {
             // Bijlagen voor nieuwsbrief berichten (afbeeldingen, bestanden, etc.)
             $table->id(); // Unieke ID
             $table->string('path'); // Pad naar het attachment bestand
             $table->unsignedBigInteger('nieuwsbrief_id'); // FK naar nieuwsbrief tabel

             // FK: Bij welk nieuwsbrief bericht hoort deze bijlage
             $table->foreign('nieuwsbrief_id')->references('id')->on('nieuwsbrief')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    //  Schema::dropIfExists('order');
     Schema::dropIfExists('nieuwsbrief_attachment');
    }
};