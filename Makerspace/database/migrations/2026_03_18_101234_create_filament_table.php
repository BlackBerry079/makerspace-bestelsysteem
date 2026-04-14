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
    Schema::create('filament', function (Blueprint $table) {
        $table->id();
        $table->string("name");
        $table->text("description");
        $table->integer("amount_available");
        $table->unsignedBigInteger("category_id")->index();
        $table->timestamps();

        $table->foreign('category_id')->references('id')->on('filament_category')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('filament');
}
};
