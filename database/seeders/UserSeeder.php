<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Mushe Abdul-Hakim',
            'username' => 'admin',
            'phone' => '0542441933',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);
        $user->assignRole('super-admin');
    }
}
