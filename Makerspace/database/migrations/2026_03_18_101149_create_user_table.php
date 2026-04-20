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
         Schema::create('user', function (Blueprint $table) {
             // Gebruikers van het systeem
             $table->id(); // Unieke ID
             $table->string('name'); // Gebruikersnaam
             $table->string('email')->unique(); // E-mailadres (uniek)
             $table->boolean('active'); // Actief/inactief
             $table->unsignedBigInteger('role_id')->default(3)->index(); // FK naar role tabel
             // $table->rememberToken(); // als de klant "remember me" wilt kunnen gebruiken
             $table->timestamps(); // Created at en Updated at

             // FK: Welke rol heeft deze gebruiker (admin, student, etc.)
             $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
            
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //  Schema::dropIfExists('users');
         Schema::dropIfExists('user');
    }
};