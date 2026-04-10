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
             
            $table->integer("id")->autoIncrement();
            $table->string('name');
            $table->text('description')->nullable();
            $table->bigInteger('filament_max')->default(2500);
            $table->enum('status', ['beschikbaar', 'onderhoud', 'niet beschikbaar'])->default('beschikbaar');
             $table->timestamp("created_at")->useCurrent();
            $table->timestamp("updated_at")->useCurrent();
            $table->string('brand')->default('Bambulab');
            
            // 
            // 13 crea 2 bambu's
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