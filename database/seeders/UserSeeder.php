<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * bs pake query builder, DB atau
     * eloquent ini adl ORM bawaan laravel
     */
    public function run(): void
    {
        //
        User::create([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'password'=>12345678
        ]);
    }
}
