<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class CmsPagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cms_pages')->insert([
        	[
        		'reseller_id' => 1,
	            'page_name' => 'About us',
	            'content' => 'About us content',
	            'url' => 'about-us',
	            'public' => 'YES',
	            'page_title' => 'Best And Cheapest SMM Panel | The Social Media Growth',
	            'meta_keyword' => 'Cheap SMM panel, Best SMM panel USA, Cheapest smm panel, Best and cheap smm panel, cheapest smm panel paypal, Tiktok smm panel',
	            'meta_description' => 'TheSocialMediaGrowth is the Worlds Best & Cheap SMM Panel With Highest Quality Services On The Market. Join Best Instagram SMM Panel With 24/7 Customer Support. Perfect For Resellers And Agencies.',
	            'status' => 'ACTIVE',
	            'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
        		'reseller_id' => 1,
	            'page_name' => 'Company',
	            'content' => 'Company content',
	            'url' => 'company',
	            'public' => 'YES',
	            'page_title' => 'Best And Cheapest SMM Panel | The Social Media Growth',
	            'meta_keyword' => 'Cheap SMM panel, Best SMM panel USA, Cheapest smm panel, Best and cheap smm panel, cheapest smm panel paypal, Tiktok smm panel',
	            'meta_description' => 'TheSocialMediaGrowth is the Worlds Best & Cheap SMM Panel With Highest Quality Services On The Market. Join Best Instagram SMM Panel With 24/7 Customer Support. Perfect For Resellers And Agencies.',
	            'status' => 'ACTIVE',
	            'created_at' => now(),
	            'updated_at' => now(),
        	],
        ]);
    }
}
