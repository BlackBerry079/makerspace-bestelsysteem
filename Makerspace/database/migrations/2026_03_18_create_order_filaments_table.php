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
         Schema::create('order_filaments', function (Blueprint $table) {
             // Tussentabel: koppelt filament aan orders (veel-op-veel relatie)
             $table->id(); // Unieke ID
             $table->unsignedBigInteger('order_id')->index(); // FK naar order tabel
             $table->unsignedBigInteger('filament_id')->index(); // FK naar filament tabel
        
             // FK: Aan welke order is dit filament gekoppeld
             $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade');
             // FK: Welk filament is gekoppeld aan deze order
             $table->foreign('filament_id')->references('id')->on('filament')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    //  Schema::dropIfExists('order');
        Schema::dropIfExists('order_filaments');
    }
};