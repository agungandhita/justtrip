<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the about page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('Frontend.about.index');
    }
}