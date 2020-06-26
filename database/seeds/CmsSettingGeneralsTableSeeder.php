<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CmsSettingGeneralsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cms_setting_generals')->insert([
            [
                'reseller_id' => Auth::user()->id,
                'keyword' => 'logo',
                'value' => '',
                'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
                'reseller_id' => Auth::user()->id,
                'keyword' => 'favicon',
                'value' => '',
                'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
                'reseller_id' => Auth::user()->id,
                'keyword' => 'panel_name',
                'value' => '',
                'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
                'reseller_id' => Auth::user()->id,
                'keyword' => 'timezone',
                'value' => '21600',
                'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
                'reseller_id' => Auth::user()->id,
                'keyword' => 'currency_format',
                'value' => '0',
                'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
                'reseller_id' => Auth::user()->id,
                'keyword' => 'rates_rounding',
                'value' => '0',
                'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
                'reseller_id' => Auth::user()->id,
                'keyword' => 'ticket_system',
                'value' => '0',
                'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
                'reseller_id' => Auth::user()->id,
                'keyword' => 'tickets_per_user',
                'value' => '0',
                'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
                'reseller_id' => Auth::user()->id,
                'keyword' => 'signup',
                'value' => '0',
                'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
                'reseller_id' => Auth::user()->id,
                'keyword' => 'skype',
                'value' => '0',
                'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
                'reseller_id' => Auth::user()->id,
                'keyword' => 'name_fields',
                'value' => '0',
                'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
                'reseller_id' => Auth::user()->id,
                'keyword' => 'terms_checkbox',
                'value' => '0',
                'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
                'reseller_id' => Auth::user()->id,
                'keyword' => 'forgot_password',
                'value' => '0',
                'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
                'reseller_id' => Auth::user()->id,
                'keyword' => 'average_time',
                'value' => '0',
                'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
                'reseller_id' => Auth::user()->id,
                'keyword' => 'custom_header',
                'value' => '',
                'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
                'reseller_id' => Auth::user()->id,
                'keyword' => 'custom_footer',
                'value' => '',
                'created_at' => now(),
	            'updated_at' => now(),
            ]
        ]);
    }
}
