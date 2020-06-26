<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CmsSettingNotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cms_setting_notifications')->insert([
        	[
        		'reseller_id' => Auth::user()->id,
	            'subject' => 'Welcome',
				'body' =>  'Hello,
Thank you for signing up.
Your username is: {{ user.username }} 
Use it to sign in to {{ panel.url }}',
				'title' => 'Welcome',
				'description' => 'Sent to new users when their account is created.',
	            'type' => '1',
	            'status' => '0',
	            'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
        		'reseller_id' => Auth::user()->id,
	            'subject' => 'Welcome',
				'body' =>   'Hello,
You requested a password change. To change your password follow the link below: {{ resetpassword.url }}',
				'title' => 'Forgot password',
				'description' => 'Sent to users when they request a password reset.',
	            'type' => '1',
	            'status' => '0',
	            'created_at' => now(),
	            'updated_at' => now(),
            ],
            [
        		'reseller_id' => Auth::user()->id,
	            'subject' => 'New message',
				'body' =>   'Hello,
You have a new message in the ticket.
Follow the link below to see the message: {{ ticket.url }}',
				'title' => 'New message',
				'description' => 'Sent to users when they receive a new message',
	            'type' => '1',
	            'status' => '0',
	            'created_at' => now(),
	            'updated_at' => now(),
        	],
            [
        		'reseller_id' => Auth::user()->id,
	            'subject' => 'Payment received',
				'body' => 'New payment #{{ payment.id }} received.
View payment in admin panel: {{ payment.admin_url }}',
				'title' => 'Payment received',
				'description' => 'Sent to staff when a user adds funds automatically.',
	            'type' => '2',
	            'status' => '0',
	            'created_at' => now(),
	            'updated_at' => now(),
        	],
            [
        		'reseller_id' => Auth::user()->id,
	            'subject' => 'New manual orders',
				'body' =>   'New manual order(s) received. Total pending manual orders: {{ orders.manual.pending_number }} 
View all manual orders in admin panel: {{ orders.manual.url }}',
				'title' => 'New manual orders',
				'description' => 'Periodically sent to staff if new manual orders received.',
	            'type' => '2',
	            'status' => '0',
	            'created_at' => now(),
	            'updated_at' => now(),
        	],
            [
        		'reseller_id' => Auth::user()->id,
	            'subject' => 'Fail orders',
				'body' =>   'Order(s) got Fail status. Total orders with Fail status: {{ orders.fail_number }}
View Fail orders in admin panel: {{ orders.fail_url }}',
				'title' => 'Fail orders',
				'description' => 'Periodically sent to staff if some orders got Fail status.',
	            'type' => '2',
	            'status' => '0',
	            'created_at' => now(),
	            'updated_at' => now(),
        	],
            [
        		'reseller_id' => Auth::user()->id,
	            'subject' => 'New messages',
				'body' =>   'New message(s) received. Total unread tickets: {{ tickets.unread_number }}
View tickets in admin panel: {{ tickets.url }}',
				'title' => 'New messages',
				'description' => 'Periodically sent to staff if new messages received.',
	            'type' => '2',
	            'status' => '0',
	            'created_at' => now(),
	            'updated_at' => now(),
        	],
            [
        		'reseller_id' => Auth::user()->id,
	            'subject' => 'New manual payout',
				'body' =>   'New manual payout request received.
View Payouts in admin panel: {{ affiliates.payouts }}',
				'title' => 'New manual payout',
				'description' => 'Sent to staff when a user create manual payout.',
	            'type' => '2',
	            'status' => '0',
	            'created_at' => now(),
	            'updated_at' => now(),
        	]
        ]);
    }
}
