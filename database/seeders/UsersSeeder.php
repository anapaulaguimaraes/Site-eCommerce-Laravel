<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'firstName' => 'Ana Paula',
            'lastName' => 'Gomes',
            'email' => 'contato@anapaula.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}

