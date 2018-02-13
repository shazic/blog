<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name'      => 'Asda Admin',
            'email'     => 'as@as.com',
            'password'  => bcrypt('asddsa12')
        ]);
    }
}
