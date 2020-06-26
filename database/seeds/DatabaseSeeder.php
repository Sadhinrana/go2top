<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(ResellerTableSeeder::class);
        $this->call(CmsPagesTableSeeder::class);
        $this->call(CmsMenusTableSeeder::class);
        $this->call(CreateCmsBlogsTable::class);
        $this->call(CmsBlogCategorysSeeder::class);
        $this->call(CmsBlogSliderTableSeeder::class);
        $this->call(GlobalPaymentMethodSeeder::class);
    }
}
