<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'is_admin' => 1,
            'password' => Hash::make('admin123pass')
        ]);

        DB::table('profiles')->insert([
            'user_id' => 1,
            'profile_image' => 'default.png',
            'about' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit totam doloribus nesciunt vitae tempore incidunt dolorum laudantium quae, eligendi aut quam similique? Est veniam blanditiis tempore sint sapiente. Labore, nemo.',
            'facebook_link' => 'www.facebook.com',
            'youtube_link' => 'www.youtube.com'
        ]);
    }
}
