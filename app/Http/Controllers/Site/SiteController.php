<?php

namespace App\Http\Controllers\Site;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function index()
    {
        $plans = Plan::with('details')->orderBy('price', 'asc')->get();
        return view('site.pages.home.index', compact('plans'));
    }
}
