<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Film;
use App\News;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::all();
        $promotion = News::orderBy('created_at', 'desc')->where('type', '=', '2')->take(3)->get();
        $news = News::orderBy('created_at', 'desc')->where('type', '=', '1')->take(3)->get();
        return view('page.index', compact('films', 'promotion', 'news'));
    }
}
