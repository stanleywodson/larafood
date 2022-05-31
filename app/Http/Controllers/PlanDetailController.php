<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\DetailPlan;
use App\Http\Requests\StoreUpdateDetailPlan;

class PlanDetailController extends Controller
{
    protected $repository, $plan;

    public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
        $this->repository = $detailPlan;
        $this->plan = $plan;
    }

    public function index($urlPlan)
    {
        if(!$plan = $this->plan->where('url', $urlPlan)->first()){
            return redirect()->back();
        }
        $details = $plan->details;
     
        return view('admin.pages.plans.details.index',[
            'plan' => $plan,
            'details' => $details
        ]);
    }
    // view de criação de um novo plano trazando informações do plano pela url
    public function create($urlPlan)
    {
        if(!$plan = $this->plan->where('url', $urlPlan)->first()){
            return redirect()->back();
        }
        return view('admin.pages.plans.details.create', compact('plan'));
    }
    //recebe o os dados do input que vem da view create
    public function store(StoreUpdateDetailPlan $request, $urlPlan)
    {
        if(!$plan = $this->plan->where('url', $urlPlan)->first()){
            return redirect()->back();
        }
        /*
        $data = $request->all();
        $data['plan_id'] = $plan->id;
        $this->repository->create($data);
        */
        $plan->details()->create($request->all());
        return redirect()->route('details.plans.index', $plan->url);
    }

    public function edit($urlPlan, $idPlan)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idPlan);

        if(!$plan && !$detail){
            return redirect()->back();
        }

        return view('admin.pages.plans.details.edit',compact('plan', 'detail'));
    }

    public function update(StoreUpdateDetailPlan $request, $urlPlan, $idPlan)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idPlan);

        if(!$plan && !$detail){
            return redirect()->back();
        }

        $detail->update($request->all());
        return redirect()->route('details.plans.index', $plan->url);
    }

    public function show($urlPlan, $idPlan)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idPlan);

        if(!$plan && !$detail){
            return redirect()->back();
        }

        return view('admin.pages.plans.details.show',compact('plan', 'detail'));
    }

    public function destroy($urlPlan, $idPlan)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idPlan);

        if(!$plan && !$detail){
            return redirect()->back();
        }
        $detail->delete();
        return redirect()->route('details.plans.index', $plan->url)
                         ->with('message', 'Arquivo deletado com sucesso!');
    }
}
