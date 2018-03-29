<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'admin',
            'phone'=>'18888888888',
            'email' => 'admin@qq.com',
            'auth'=>'3',
            'password' => bcrypt('000000'),
        ]);
    }
}
