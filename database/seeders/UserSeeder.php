<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@onenex.co'],
            [
                'name' => 'Admin',
                'email' => 'admin@onenex.co',
                'password' => bcrypt('password'),
            ]
        );
    }
}
