<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('pages.frontend.index');
    }

    public function details($slug)
    {
        return view('pages.frontend.details');
    }

    public function cart()
    {
        return view('pages.frontend.cart');
    }

    public function sucess()
    {
        return view('pages.frontend.sucess');
    }
}
