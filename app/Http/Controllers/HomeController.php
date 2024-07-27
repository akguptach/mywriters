<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //

    public function index()
    {

        $tutor_id               =   Auth::id();
        if($tutor_id)
        {
            return redirect()->route('dashboard');
        }

        return view('home/index');
    }
}