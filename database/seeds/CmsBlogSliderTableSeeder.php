<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CmsBlogSliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cms_blog_sliders')->insert([
            [
        		'reseller_id' => 1,
                'title' => 'FACEBOOK PAGE LIKES',
                'image' => '',
	            'status' => '1',
	            'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
        		'reseller_id' => 1,
                'title' => 'BUY INSTAGRAM FOLLOWERS',
                'image' => '',
	            'status' => '0',
	            'created_at' => now(),
	            'updated_at' => now(),
        	],
        ]);
    }
}
