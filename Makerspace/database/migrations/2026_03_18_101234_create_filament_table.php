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
        $table->string("description");
        $table->integer("amount_available");
        $table->timestamps(); // created_at en updated_at
        $table->boolean("active");
    });
}

public function down(): void
{
    // Schema::dropIfExists('filament');
}
};
