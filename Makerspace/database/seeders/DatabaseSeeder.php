<?php

namespace Database\Seeders;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\error;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
            $test_data_role=[
               [

                   'name' => 'admin'
               ],
               [
                   'name' => 'user'
               ]
           ];
           
           foreach($test_data_role as $role){
               DB::table('role')->insert([
                   $role
               ]);
           }
        
        $test_data_users=[
            [
                'name' => 'Alice Jansen',
                'email' => '@davinci.nl',
                // cijfers horen 8 te zijn + @davinci.nl
                'role' => 'admin',
                'active' => true
            ],
         
        ];

        foreach ($test_data_users as $test) {
            DB::table('user')->insert([
                ...$test,   
                'created_at' => now(),
                'updated_at' => now(),
                
                // email check if 9 cijfers + @davinci.nl er in zit 
                if ($test['email']) {
                    return $test['email'];
                } else {
                    throw error('email is niet geldig');
                }
            
            ]);
        }
    }
}