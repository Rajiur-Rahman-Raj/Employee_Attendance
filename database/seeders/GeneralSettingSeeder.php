<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GeneralSetting;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GeneralSetting::create([
            'email'      => 'admin@admin.com',
            'phone'     => '12345678',
            'address'     => 'demo@demo.com',
            'logo'   => 'demo.jpg',
            'favicon'   => 'demo.png',
            'meta_title'   => 'lorem ipsum',
            'meta_description'   => 'lorem ipsum',
            'meta_keywords'   => 'lorem ipsum',
        ]);
    }
}
