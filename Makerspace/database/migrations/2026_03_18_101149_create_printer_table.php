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
             
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('filament_max')->default(25);
            $table->enum('status', ['beschikbaar', 'onderhoud', 'in gebruik'])->default('beschikbaar');
            $table->timestamps();
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