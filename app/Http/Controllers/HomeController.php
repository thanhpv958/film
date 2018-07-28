<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use App\Film;
use App\Seat;
use App\Comment;
use App\News;
use App\Ticket;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::all();
        $promotion = News::orderBy('created_at', 'desc')->where('type', '2')->where('status', 1)->take(3)->get();
        $news = News::orderBy('created_at', 'desc')->where('type', '1')->where('status', 1)->take(3)->get();

        return view('page.index', compact('films', 'promotion', 'news'));
    }

    public function indexAdmin()
    {
        $filmCount = Film::where('type', 1)->where('status', 1)->count();
        $seatCount = Seat::count();
        $ticketCount = Ticket::count();
        $comments = Comment::orderBy('created_at', 'desc')->get();

        return view('admin.layout.index', compact('filmCount', 'seatCount', 'ticketCount', 'comments'));
    }

    public function changeLanguage($locale)
    {
        if (in_array($locale, \Config::get('app.locales'))) {
            Session::put('locale', $locale);
        }
        return redirect()->back();
    }
}
