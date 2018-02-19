<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Setting::create([
            'site_name'         => 'Laravel-Blog',
            'contact_number'    => '9811009987',
            'contact_email'     => 'abc@example.com',
            'address'           => 'First Street, Second Floor, Downtown, Country 110 001'
        ]);
    }
}
