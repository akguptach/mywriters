<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function account(){
        return view('orders/account');
    }
    public function completed(){
        return view('orders/completed');
    }
    public function open(){
        return view('orders/open');
    }
}
