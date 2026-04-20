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
         Schema::create('order', function (Blueprint $table) {
             // Print orders van gebruikers
             $table->id(); // Unieke ID
             $table->string('title'); // Titels van de order
             $table->text('description'); // Beschrijving
             $table->string('file_path'); // Pad naar het 3D model bestand
             $table->unsignedBigInteger('user_id')->index(); // FK naar user tabel
             $table->unsignedBigInteger('filament_id')->index(); // FK naar filament tabel
             $table->unsignedBigInteger('printer_id')->index(); // FK naar printer tabel
             $table->timestamps(); // Created at en Updated at

             // FK: Welke gebruiker heeft deze order geplaatst
             $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
             // FK: Welk filament wordt gebruikt voor deze order
             $table->foreign('filament_id')->references('id')->on('filament')->onDelete('cascade');
             // FK: Op welke printer moet deze order gedraaid worden
             $table->foreign('printer_id')->references('id')->on('printer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};