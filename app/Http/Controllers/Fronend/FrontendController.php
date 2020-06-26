<?php

namespace App\Http\Controllers\Fronend;

use App\CmsBlog;
use App\CmsMenu;
use App\Category;
use App\SupportTicket;
use App\CmsBlogCategory;
use Illuminate\Http\Request;
use App\SupportTicketComment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function getPublicMenus(){
        return CmsMenu::leftJoin('cms_pages', 'cms_pages.id', '=', 'cms_menus.menu_link_id')
            ->where('cms_menus.menu_link_type','Yes')
            ->orderBy('sort', 'ASC')
            ->get();
    }


    public function getAccount()
    {
        $ticketIds = SupportTicket::where(['user_id' => Auth::user()->id])->get()->pluck('id')->toArray();
        $unreadMessages = 12; //SupportTicketComment::whereIn('ticket_id', $ticketIds)->whereNotIn('user_id', [Auth::user()->id])->count();
        $tzlist = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
        return view('frontend.settings', compact('tzlist', 'unreadMessages'));
    }


    public function getSignedMenus()
    {
        return CmsMenu::leftJoin('cms_pages', 'cms_pages.id', '=', 'cms_menus.menu_link_id')
        ->where('cms_menus.menu_link_type','No')
        ->orderBy('sort', 'ASC')
        ->get();
    }

    public function showServicefrontEnd()
    {
        $cate_services = Category::with('services')->get();
        return view('frontend.show_service', compact('cate_services'));
    }





    /* seamless functions */
    public function getBlogCategoryLists()
    {
        $category = CmsBlogCategory::select('cms_blog_categories.*', 'count_posts')
        ->leftJoin(\DB::raw('(select category_id, count(*) as count_posts from cms_blogs group by category_id) as B'), 'B.category_id', '=', 'cms_blog_categories.id')
        ->where('cms_blog_categories.status', '1')->get();
        return $category;
    }

    public function getPopularPosts()
    {
        return  CmsBlog::where('type', '2')->take(4)->inRandomOrder()->get();
    }
    public function getTrendingPosts()
    {
        return  CmsBlog::where('type', '1')->take(6)->inRandomOrder()->get();
    }

    public function thanks()
    {

        return view('thank_you');
    }
}
