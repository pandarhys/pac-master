<?php

namespace App\Http\Controllers;

use App\Article;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//TODO:Consider PAC home page for non logged in users, view public articles only
//        return view('home');
        $articles = auth()->user()->accessibleArticles();
        return view('article.index', compact('articles'));
    }
}
