<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Display the destinations page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('Frontend.destinations.index');
    }
}