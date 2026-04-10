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
             $table->string('title'); //  was linestring
            $table->string('description');
             $table->string('type');
             $table->timestamp("created_at")->useCurrent();
            //  $table->integer('filament_id');
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