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
         Schema::create('orders', function (Blueprint $table) {
             
             $table->id('id');
             $table->string('title');
             $table->string('description');
             $table->string('file_path');
             
             $table->integer('user_id');
             $table->integer('filament_id');
            
            $table->integer('active');
            $table->timestamp("created_at");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    //  Schema::dropIfExists('orders');
    }
};