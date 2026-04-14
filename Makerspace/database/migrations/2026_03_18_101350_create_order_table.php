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
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('filament_id')->index();
            $table->unsignedBigInteger('printer_id')->index();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('filament_id')->references('id')->on('filament')->onDelete('cascade');
            $table->foreign('printer_id')->references('id')->on('printer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};