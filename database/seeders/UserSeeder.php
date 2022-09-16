<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ThemeSetting;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user =  User::create([
            'name'              => 'Admin', 
            'email'             => 'admin@admin.com', 
            'password'          => bcrypt('@@Bladepro@123@@'), 
            'email_verified_at' => Carbon::now(),
        ]);
      $user2 =  User::create([
            'name'              => 'Raju', 
            'email'             => 'raju@raju.com', 
            'password'          => bcrypt('raju@raju.com'), 
            'email_verified_at' => Carbon::now(),
        ]);

      $user3 =  User::create([
            'name'              => 'Tareq', 
            'email'             => 'tareq@tareq.com', 
            'password'          => bcrypt('tareq@tareq.com'), 
            'email_verified_at' => Carbon::now(),
        ]);
        
        ThemeSetting::create([
            'user_id' => $user->id, 
            'created_at' => Carbon::now(), 
        ]); 
        ThemeSetting::create([
            'user_id' => $user2->id, 
            'created_at' => Carbon::now(), 
        ]); 
        ThemeSetting::create([
            'user_id' => $user3->id, 
            'created_at' => Carbon::now(), 
        ]); 
    }
}
