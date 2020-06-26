<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verified');
    }

    public function homePage()
    {
        return view('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::with('services')->get();
        $user_service_prices = auth()->user()->servicesList()->get();
        if (count($user_service_prices) > 0) {
            foreach ($user_service_prices as $user_price) {
                foreach ($categories as &$category) {
                    foreach ($category->services as &$cs) {
                        if ($cs->id == $user_price->id) {
                            $cs->price  = $user_price->pivot_price;
                        }
                    }
                }

            }
        }
        //dd($user_service_prices, $categories);
        return view('frontend.orders.make_single_new_order',compact('categories'));
    }

    public function massOrder()
    {
        return view('frontend.orders.mass_order');
    }
}
