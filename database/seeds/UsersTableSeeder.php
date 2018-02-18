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
        $user = 
        App\User::create([
            'name'      => 'Asda Admin',
            'email'     => 'as@as.com',
            'password'  => bcrypt('asddsa12'),
            'admin'     => 1
        ]);

        App\Profile::create([
            'avatar'    => 'uploads/avatars/1.jpg',
            'user_id'   => $user->id,
            'about'     => 'Hi! I am admin.',
            'facebook'  => 'facebook.com',
            'youtube'   => 'youtube.com',
            'twitter'   => 'twitter.com'
        ]);
    }
}
