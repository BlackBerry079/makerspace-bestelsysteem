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
         Schema::create('nieuwsbrief_attachment_id', function (Blueprint $table) {
             
            $table->id();
            $table->lineString('path');
            $table->unsignedBigInteger('nieuwsbrief_id');

            $table->foreign('nieuwsbrief_id')->references('id')->on('nieuwsbrief')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    //  Schema::dropIfExists('order');
     Schema::dropIfExists('nieuwsbrief_attachment_id');
    }
};