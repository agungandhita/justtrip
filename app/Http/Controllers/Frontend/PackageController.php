<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display the packages page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('Frontend.packages.index');
    }
}