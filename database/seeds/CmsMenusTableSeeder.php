<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CmsMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* DB::table('cms_menus')->insert([
        	[
        		'reseller_id' => 1,
	            'menu_name' => 'About us',
	            'external_link' => '',
	            'menu_link_id' => 1,
	            'menu_link_type' => 'Yes',
	            'status' => 'ACTIVE',
	            'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
        		'reseller_id' => 1,
				'menu_name' => 'Company',
				'external_link' => '',
	            'menu_link_id' => 2,
	            'menu_link_type' => 'No',
	            'status' => 'ACTIVE',
	            'created_at' => now(),
	            'updated_at' => now(),
        	],

        ]); */

    }
}
