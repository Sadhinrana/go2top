<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Fronend\FrontendController;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $menus = new FrontendController;
        View::composer('layouts.app_consumer', function ($q) use($menus) {
            $q->with('public_menus', $menus->getPublicMenus());
            $q->with('signed_menus', $menus->getSignedMenus());
        });

        view()->composer('blog.components.category_sidebar', function ($q) use($menus) {
            $q->with('category_lists', $menus->getBlogCategoryLists());
        });

        view()->composer('blog.components.category_popular', function ($q) use($menus) {
            $q->with('PopularPosts', $menus->getPopularPosts());
        });
        view()->composer('blog.components.posts_trending', function ($q) use($menus) {
            $q->with('trendingPosts', $menus->getTrendingPosts());
        });

        Schema::defaultStringLength(191);
    }
}
