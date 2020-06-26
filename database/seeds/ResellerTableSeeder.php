<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResellerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resellers')->insert([
        	[
        		'name' => 'Sudip Palash',
	            'email' => 'palash.sudip@gmail.com',
	            'password' => bcrypt('12345678'),
	            'status' => 'approved',
	            'created_at' => now(),
	            'updated_at' => now(),
        	],
        ]);
    }
}
