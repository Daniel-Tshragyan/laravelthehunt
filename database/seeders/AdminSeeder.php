<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $admin = DB::table('users')->where(['email'=>'admin'])->exists();
        if (!$admin) {
            DB::table('users')->insert([
                'name' =>'Admin',
                'email' => 'admin',
                'role' => 'admin',
                'password' => Hash::make('123'),
            ]);
        }
    }
}
