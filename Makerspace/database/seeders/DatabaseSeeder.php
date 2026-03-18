<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $test_data_users=[
            [
                'name' => 'Alice Jansen',
                'email' => 'alice@example.com',
                'role' => 'admin',
                'active' => true
            ],
            [
                'name' => 'Bob de Vries',
                'email' => 'bob@example.com',
                'role' => 'user',
                'active' => true
            ],
                [
                    'name' => 'Clara van Dijk',
                    'email' => 'clara@example.com',
                    'role' => 'user',
                    'active' => false
                ]
        ];

        foreach ($test_data_users as $test) {
            DB::table('users')->insert([
                ...$test,                     
            ]);
        }
    }
}