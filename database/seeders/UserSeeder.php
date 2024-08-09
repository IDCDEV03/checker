<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new \App\Models\User();
        $user->name = "Admin";
        $user->email = "admin@gmail.com";
        $user->password = Hash::make('admin@gmail.com');
        $user->password_2 = 'admin@gmail.com';
        $user->role = 'admin';
        $user->save();

        $user = new \App\Models\User();
        $user->name = "Akara Resources";
        $user->email = "akara@gmail.com";
        $user->password = Hash::make('akara@gmail.com');
        $user->password_2 = 'akara@gmail.com';
        $user->role = 'user';
        $user->save();

        $user = new \App\Models\User();
        $user->name = "Thainamthip";
        $user->email = "tnt@gmail.com";
        $user->password = Hash::make('tnt@gmail.com');
        $user->password_2 = 'tnt@gmail.com';
        $user->role = 'company';
        $user->save();

        $user = new \App\Models\User();
        $user->name = "CocaCola";
        $user->email = "coke@gmail.com";
        $user->password = Hash::make('coke@gmail.com');
        $user->password_2 = 'coke@gmail.com';
        $user->role = 'leader';
        $user->save();
    }
}
