<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function profile()
    {
        return view('profile');
    }


    public function forum()
    {
        return view('forum');
    }

}
