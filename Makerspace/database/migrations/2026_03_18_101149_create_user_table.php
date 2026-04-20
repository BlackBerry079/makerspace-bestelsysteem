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
             
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->boolean('active');
            $table->unsignedBigInteger('role_id')->default(3)->index();
            // $table->rememberToken(); // als de klant "remember me" wilt kunnen gebruiken
            $table->timestamps();

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