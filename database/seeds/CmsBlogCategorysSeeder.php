<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CmsBlogCategorysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cms_blog_categories')->insert([
        	[
        		'reseller_id' => 1,
	            'name' => 'FACEBOOK PAGE LIKES',
	            'status' => '1',
	            'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
        		'reseller_id' => 1,
	            'name' => 'BUY INSTAGRAM FOLLOWERS',
	            'status' => '0',
	            'created_at' => now(),
	            'updated_at' => now(),
        	],
        ]);
    }
}
