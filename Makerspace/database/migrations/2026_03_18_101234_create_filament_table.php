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
        $table->bigInteger('id');
        $table->bigInteger("name");
        $table->bigInteger("description");

        $table->integer("category_id");
        $table->bigInteger("amount_available");
        
        $table->timestamp("created_at")->nullable();
        $table->bigInteger("active");
        $table->timestamp("updated_at")->nullable();    });
}

public function down(): void
{
    Schema::dropIfExists('filament');
}
};
