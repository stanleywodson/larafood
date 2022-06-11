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
    // metodo para gravar a sessão, e redirecionar para o register caso nao aja plano contratado
    public function plan($url)
    {
        if(!$plan = Plan::where('url', $url)->first()){
            return redirect()->back();
        }
        
       session()->put('plan', $plan);
       

        return redirect()->route('register');
    }
}
