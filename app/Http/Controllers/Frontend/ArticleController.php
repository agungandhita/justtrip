<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display the articles page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('Frontend.articles.index');
    }
}