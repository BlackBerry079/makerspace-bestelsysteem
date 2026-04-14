<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
            $test_data_role=[
                [
                    'name' => 'superadmin'
                ],
                [
                    'name' => 'admin'
                ],
                [
                   'name' => 'user'
                ]
           ];
           
           foreach($test_data_role as $role){
               DB::table('role')->insert(
                   $role
               );
           }
        
        $test_data_users=[
            [
                'name' => 'stephen Kusters',
                'email' => '99073048@mydavinci.nl',
                'role' => 'admin',
                'active' => true
            ],
            // [
            //     'name' => 'Bob Jansen',
            //     'email' => '@davinci.nl',
            //     // cijfers horen 8 te zijn + @davinci.nl
            //     'role' => 'admin',
            //     'active' => true
            // ]
         
        ];

        foreach ($test_data_users as $test) {
            // email check if 9 cijfers + @davinci.nl er in zit 
            // if (str_contains($test['email'], '@mydavinci.nl') === false || strlen($test['email']) != 19) {
            //      throw new \Exception('email is niet geldig');
            // }
            DB::table('user')->insert([
                ...$test,   
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}