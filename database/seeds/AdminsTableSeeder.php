<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
        	[
        		'name' => 'Sadhin Rana',
	            'email' => 'smsadhin123@gmail.com',
	            'password' => bcrypt('12345678'),
	            'role' => 'super',
	            'created_at' => now(),
	            'updated_at' => now(),
        	],
        	[
        		'name' => 'Sudip Palash',
	            'email' => 'palash.sudip@gmail.com',
	            'password' => bcrypt('12345678'),
	            'role' => 'admin',
	            'created_at' => now(),
	            'updated_at' => now(),
        	],
        ]);
    }
}
