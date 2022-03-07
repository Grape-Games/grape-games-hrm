<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'i160289@nu.edu.pk',
            'password' => Hash::make('12345678'),
            'role' => 'manager'
        ]);
        $user->addMedia(public_path('assets/img/avatar.png'))->preservingOriginal()->toMediaCollection('avatars', 'avatars');

        $user = User::create([
            'name' => 'Admin',
            'email' => 'hr@grapegames.net',
            'password' => Hash::make('google@me'),
            'role' => 'manager'
        ]);
        $user->addMedia(public_path('assets/img/avatar.png'))->preservingOriginal()->toMediaCollection('avatars', 'avatars');
    }
}
