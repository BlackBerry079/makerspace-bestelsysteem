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
         Schema::create('role', function (Blueprint $table) {
             // Rollen tabel voor gebruikersmachtigingen
             $table->id(); // Unieke ID
             $table->string('name'); // Rolnaam (admin, student, etc.)
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    //  Schema::dropIfExists('order');
     Schema::dropIfExists('role');
    }
};