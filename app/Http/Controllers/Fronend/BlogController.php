<?php

namespace App\Http\Controllers\Fronend;

use App\CmsBlog;
use App\CmsBlogSlider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index(Request $r)
    {
        if ($r->has('filter_by_category')) {
            $items = CmsBlog::where('category_id',$r->filter_by_category)->orderBy('id', 'DESC')->inRandomOrder()->paginate(6);
        }
        else
        {
            $items = CmsBlog::orderBy('id', 'DESC')->inRandomOrder()->paginate(6);
        }
       
        $sliders = CmsBlogSlider::where('status', 1)->get();
        return view('blog.index', compact('items', 'sliders'));

    }

    public function blogpost()
    {
        $items = CmsBlog::orderBy('id', 'DESC')->paginate(100);
        return view('blog.blogpost', compact('items'));
    }

    public function post($slug)
    {
        $post = CmsBlog::where('slug',$slug)->first();

        return view('blog.post',compact('post'));
    }
}
