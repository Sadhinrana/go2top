<?php

namespace App\Console\Commands;

use App\CmsPage;
use Illuminate\Console\Command;

class RequiredPages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'r_pages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate required pages';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $pages = [
            [
                'reseller_id' => 1,
                'page_name' => 'New Order',
                'content' => 'new Order Content',
                'url' => 'new_order',
                'public' => 'NO',
                'page_title' => 'New Order information',
                'meta_keyword' => 'Cheap SMM panel, Best SMM panel USA, Cheapest smm panel, Best and cheap smm panel, cheapest smm panel paypal, Tiktok smm panel',
                'meta_description' => 'TheSocialMediaGrowth is the Worlds Best & Cheap SMM Panel With Highest Quality Services On The Market. Join Best Instagram SMM Panel With 24/7 Customer Support. Perfect For Resellers And Agencies.',
                'status' => 'ACTIVE',
                'non_editable' => true,
            ],
            [
                'reseller_id' => 1,
                'page_name' => 'Deposit',
                'content' => 'add funds',
                'url' => 'add-funds',
                'public' => 'NO',
                'page_title' => 'Add funds to waltet',
                'meta_keyword' => 'Cheap SMM panel, Best SMM panel USA, Cheapest smm panel, Best and cheap smm panel, cheapest smm panel paypal, Tiktok smm panel',
                'meta_description' => 'TheSocialMediaGrowth is the Worlds Best & Cheap SMM Panel With Highest Quality Services On The Market. Join Best Instagram SMM Panel With 24/7 Customer Support. Perfect For Resellers And Agencies.',
                'status' => 'ACTIVE',
                'non_editable' => true,
            ],
            [
                'reseller_id' => 1,
                'page_name' => 'Support',
                'content' => 'support ticket',
                'url' => 'supportTickets',
                'public' => 'NO',
                'page_title' => 'support ticket to waltet',
                'meta_keyword' => 'Cheap SMM panel, Best SMM panel USA, Cheapest smm panel, Best and cheap smm panel, cheapest smm panel paypal, Tiktok smm panel',
                'meta_description' => 'TheSocialMediaGrowth is the Worlds Best & Cheap SMM Panel With Highest Quality Services On The Market. Join Best Instagram SMM Panel With 24/7 Customer Support. Perfect For Resellers And Agencies.',
                'status' => 'ACTIVE',
                'non_editable' => true,
            ],
            [
                'reseller_id' => 1,
                'page_name' => 'Home',
                'content' => 'Smm panel',
                'url' => '/',
                'public' => 'YES',
                'page_title' => 'New Order information',
                'meta_keyword' => 'Cheap SMM panel, Best SMM panel USA, Cheapest smm panel, Best and cheap smm panel, cheapest smm panel paypal, Tiktok smm panel',
                'meta_description' => 'TheSocialMediaGrowth is the Worlds Best & Cheap SMM Panel With Highest Quality Services On The Market. Join Best Instagram SMM Panel With 24/7 Customer Support. Perfect For Resellers And Agencies.',
                'status' => 'ACTIVE',
                'non_editable' => true,
            ],
            [
                'reseller_id' => 1,
                'page_name' => 'Faq',
                'content' => 'Smm panel',
                'url' => 'faq',
                'public' => 'YES',
                'page_title' => 'New Order information',
                'meta_keyword' => 'Cheap SMM panel, Best SMM panel USA, Cheapest smm panel, Best and cheap smm panel, cheapest smm panel paypal, Tiktok smm panel',
                'meta_description' => 'TheSocialMediaGrowth is the Worlds Best & Cheap SMM Panel With Highest Quality Services On The Market. Join Best Instagram SMM Panel With 24/7 Customer Support. Perfect For Resellers And Agencies.',
                'status' => 'ACTIVE',
                'non_editable' => true,
            ],
            [
                'reseller_id' => 1,
                'page_name' => 'About Us',
                'content' => 'Smm panel',
                'url' => 'about-us',
                'public' => 'YES',
                'page_title' => 'New Order information',
                'meta_keyword' => 'Cheap SMM panel, Best SMM panel USA, Cheapest smm panel, Best and cheap smm panel, cheapest smm panel paypal, Tiktok smm panel',
                'meta_description' => 'TheSocialMediaGrowth is the Worlds Best & Cheap SMM Panel With Highest Quality Services On The Market. Join Best Instagram SMM Panel With 24/7 Customer Support. Perfect For Resellers And Agencies.',
                'status' => 'ACTIVE',
                'non_editable' => true,
            ],
            /* [
                'reseller_id' => 1,
                'page_name' => 'Mass Order',
                'content' => 'mass Order Content',
                'url' => 'mass_order',
                'public' => 'NO',
                'page_title' => 'New Order information',
                'meta_keyword' => 'Cheap SMM panel, Best SMM panel USA, Cheapest smm panel, Best and cheap smm panel, cheapest smm panel paypal, Tiktok smm panel',
                'meta_description' => 'TheSocialMediaGrowth is the Worlds Best & Cheap SMM Panel With Highest Quality Services On The Market. Join Best Instagram SMM Panel With 24/7 Customer Support. Perfect For Resellers And Agencies.',
                'status' => 'ACTIVE',
                'non_editable' => true,
            ], */
            [
                'reseller_id' => 1,
                'page_name' => 'Orders',
                'content' => 'mass Order Content',
                'url' => 'orders',
                'public' => 'NO',
                'page_title' => 'New Order information',
                'meta_keyword' => 'Cheap SMM panel, Best SMM panel USA, Cheapest smm panel, Best and cheap smm panel, cheapest smm panel paypal, Tiktok smm panel',
                'meta_description' => 'TheSocialMediaGrowth is the Worlds Best & Cheap SMM Panel With Highest Quality Services On The Market. Join Best Instagram SMM Panel With 24/7 Customer Support. Perfect For Resellers And Agencies.',
                'status' => 'ACTIVE',
                'non_editable' => true,
            ],
            [
                'reseller_id' => 1,
                'page_name' => 'Blog',
                'content' => 'mass Order Content',
                'url' => 'blog',
                'public' => 'Yes',
                'page_title' => 'New Order information',
                'meta_keyword' => 'Cheap SMM panel, Best SMM panel USA, Cheapest smm panel, Best and cheap smm panel, cheapest smm panel paypal, Tiktok smm panel',
                'meta_description' => 'TheSocialMediaGrowth is the Worlds Best & Cheap SMM Panel With Highest Quality Services On The Market. Join Best Instagram SMM Panel With 24/7 Customer Support. Perfect For Resellers And Agencies.',
                'status' => 'ACTIVE',
                'non_editable' => true,
            ],
            [
                'reseller_id' => 1,
                'page_name' => 'Service',
                'content' => 'Services public',
                'url' => 's-service',
                'public' => 'YES',
                'page_title' => 'New Order information',
                'meta_keyword' => 'Cheap SMM panel, Best SMM panel USA, Cheapest smm panel, Best and cheap smm panel, cheapest smm panel paypal, Tiktok smm panel',
                'meta_description' => 'TheSocialMediaGrowth is the Worlds Best & Cheap SMM Panel With Highest Quality Services On The Market. Join Best Instagram SMM Panel With 24/7 Customer Support. Perfect For Resellers And Agencies.',
                'status' => 'ACTIVE',
                'non_editable' => true,
            ],
            [
                'reseller_id' => 1,
                'page_name' => 'Service',
                'content' => 'Service signed in',
                'url' => 'service',
                'public' => 'NO',
                'page_title' => 'New Order information',
                'meta_keyword' => 'Cheap SMM panel, Best SMM panel USA, Cheapest smm panel, Best and cheap smm panel, cheapest smm panel paypal, Tiktok smm panel',
                'meta_description' => 'TheSocialMediaGrowth is the Worlds Best & Cheap SMM Panel With Highest Quality Services On The Market. Join Best Instagram SMM Panel With 24/7 Customer Support. Perfect For Resellers And Agencies.',
                'status' => 'ACTIVE',
                'non_editable' => true,
            ],

        ];
        foreach ($pages as $page)
        {
            $the_page = CmsPage::updateOrCreate(['url'=>$page['url']],$page);
            $the_page->menus()->updateOrCreate(['menu_link_id'=>$the_page->id],[
                    'reseller_id' => 1,
                    'menu_name' => $page['page_name'],
                    'menu_link_type' =>  $page['public'],
                    'status' => 'ACTIVE',
                    'created_at' => now(),
                    'updated_at' => now(),
            ]);
        }
    }
}
