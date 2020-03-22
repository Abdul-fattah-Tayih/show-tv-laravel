<?php

namespace App\Http\Controllers;

use App\Episode;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', ['episodes' => Episode::latest()->paginate()]);
    }
}
