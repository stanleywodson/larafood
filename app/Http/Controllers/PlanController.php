<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class PlanController extends Controller
{
    private object $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;
    }

    public function index()
    {
        $plans = $this->repository->all();
    
        return view('admin.pages.plan.index',[
            'plans' => $plans,
        ]);
    }
    
    public function create()
    {
        return view('admin.pages.plan.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['url'] =  Str::kebab($request->name);
        $this->repository->create($data);

        return redirect()->route('plans.index');
    }
    //pegar um único plano
    public function show($url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if(!$plan)
            return redirect()->back();

            return view('admin.pages.plan.show',[
                'plan' => $plan]);
    }
    //deletar um plano
    public function destroy($url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if(!$plan)
            return redirect()->back();

        $plan->delete();

        return redirect()->route('plans.index');
    }

    public function search(Request $request)
    {
        $plans = $this->repository->search($request->filter);

        return view('admin.pages.plan.index',[
            'plans' => $plans,
        ]);
    }
}
