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
             
            $table->id();
            $table->string('title'); 
            $table->text('description');
            $table->enum('type', ['announcement', 'stock', 'error', 'info']); 
            $table->unsignedBigInteger('filament_id')->nullable()->index();
            $table->timestamps();

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