<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();

        $user->name = 'Samuele Passiatore';
        $user->email = 'samuw.978@gmail.com';
        $user->password = bcrypt('Chapeaux');

        $user->save();
    }
}
