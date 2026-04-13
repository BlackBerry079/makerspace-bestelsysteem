<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('filament', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->text('description');

            $table->unsignedBigInteger('category_id');
            $table->integer('amount_available');

            $table->boolean('active')->default(true);

            $table->timestamps();
        });

        DB::table('filaments')->insert([
            [
                'name' => 'Rood',
                'description' => 'Dieprode kleur filament',
                'category_id' => 1,
                'amount_available' => 50,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Blauw',
                'description' => 'Helder blauwe kleur filament',
                'category_id' => 1,
                'amount_available' => 40,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Groen',
                'description' => 'Fris groene kleur filament',
                'category_id' => 1,
                'amount_available' => 35,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('filament');
    }
};