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
         Schema::create('order', function (Blueprint $table) {
             
             $table->id();
           $table->string('title');
            $table->text('description');
            $table->string('file_path');
             $table->integer('user_id');
             $table->integer('filament_id');
             $table->integer('printer_id');
            $table->timestamp("created_at")->nullable();
            $table->timestamp("updated_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
     Schema::dropIfExists('order');
     Schema::dropIfExists('orders');
    }
};