<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Superuser',
            'email' => 'admin@indahjaya.co.id',
            'username' => 'superuser',
            'email_verified_at' => now(),
            'password' => Hash::make('R4ha514'),
            'remember_token' => Str::random(10),
            'created_by' => 1,
            'updated_by' => 1
        ]);
    }
}
