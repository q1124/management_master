<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'account' => '9',
            'name' => "管理員",
            'role' => 99,
            'password' => '9',
        ]);

        DB::table('users')->insert([
            'account' => '1',
            'name' => "訪客",
            'role' => 1,
            'password' => '1',
        ]);
    }
}
