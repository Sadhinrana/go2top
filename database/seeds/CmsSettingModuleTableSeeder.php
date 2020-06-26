<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CmsSettingModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cms_setting_modules')->insert([
        	[
        		'reseller_id' => Auth::user()->id,
	            'amount' => 0,
	            'commission_rate' => '0',
				'approve_payout' => '0',
				'title' => 'Affiliate system',
				'description' => 'Existing users (affiliates) invite new users (referrals) and get commissions from all their payments. Affiliates may request payouts when they save the minimum payout.',
	            'type' => '1',
	            'status' => '0',
	            'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
        		'reseller_id' => Auth::user()->id,
	            'amount' => 0,
	            'commission_rate' => '0',
				'approve_payout' => '0',
				'title' => 'Child panels selling',
				'description' => 'A panel with limited features that can have only your panel as a service provider. Users can order child panels on your panel.',
	            'type' => '2',
	            'status' => '0',
	            'created_at' => now(),
	            'updated_at' => now(),
			],
			[
        		'reseller_id' => Auth::user()->id,
	            'amount' => 0,
	            'commission_rate' => '0',
				'approve_payout' => '0',
				'title' => 'Free balance',
				'description' => 'Set up a one-time free balance amount for new panel users after signing up.',
	            'type' => '3',
	            'status' => '0',
	            'created_at' => now(),
	            'updated_at' => now(),
        	]
        ]);
    }
}
