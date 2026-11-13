<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class DestinationController extends Controller
{
    /**
     * Redirect to the packages page (301 Permanent Redirect).
     */
    public function index(): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('packages.index', [], 301);
    }
}
