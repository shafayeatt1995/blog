<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'name' => 'Md. Admin',
            'role_id' => '1',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('2280'),
        ]);
        DB::table('users')->insert([
            'name' => 'Md. Author',
            'role_id' => '2',
            'username' => 'author',
            'email' => 'author@gmail.com',
            'password' => bcrypt('2280'),
        ]);
    }
}
