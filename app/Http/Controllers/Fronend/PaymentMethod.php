<?php

namespace App\Http\Controllers\Fronend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentMethod extends Controller
{
    public function index(){
        return view('frontend.payments.index');
    }
}
