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
             
            $table->bigInteger("id");
            $table->lineString('name');
            $table->lineString('description');
            $table->bigInteger('filament_max');
            $table->enum('status', ['beschikbaar', 'onderhoud', 'niet beschikbaar'])->default('beschikbaar');
             $table->timestamp("created_at")->nullable();
            $table->timestamp("updated_at")->nullable();
            $table->enum('brand', ['Bambulab', 'Creality Ender V3',])->default('Bambulab');
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