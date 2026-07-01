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
        Schema::table('user', function (Blueprint $table) {
            if (! Schema::hasColumn('user', 'password')) {
                $table->string('password')->after('email');
            }

            if (! Schema::hasColumn('user', 'active')) {
                $table->boolean('active')->default(true)->after('password');
            }
        });

        Schema::table('user', function (Blueprint $table) {
            $table->unique('name', 'user_name_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            try {
                $table->dropUnique('user_name_unique');
            } catch (Throwable $e) {
                // Keep rollback safe when index does not exist.
            }

            if (Schema::hasColumn('user', 'password')) {
                $table->dropColumn('password');
            }
        });
    }
};
