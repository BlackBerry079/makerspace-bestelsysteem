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
             
             $table->id();
             $table->bigInteger('order_id');
             $table->bigInteger('filament_id');
        
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