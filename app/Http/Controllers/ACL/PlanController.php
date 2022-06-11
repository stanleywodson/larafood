<?php
namespace App\Http\Controllers\ACL;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdatePlan;

class PlanController extends Controller
{
    private object $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;
    }
    //lista todos o planos na página inicial
    public function index()
    {
        $plans = $this->repository->all();
    
        return view('admin.pages.plans.index',[
            'plans' => $plans,
        ]);
    }
    //view do create
    public function create()
    {
        return view('admin.pages.plans.create');
    }
    //recebe a requisição da view create e persiste os dados
    public function store(StoreUpdatePlan $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('plans.index');
    }
    //pegar um único plano
    public function show($url)
    {
        $plan = $this->repository->where('url', $url)->first();
        
        if(!$plan)
            return redirect()->back();

            return view('admin.pages.plans.show',[
                'plan' => $plan]);
    }
    //deletar um plano
    public function destroy($url)
    {
        $plan = $this->repository
        ->with('details')   
        ->where('url', $url)->first();         
        
        if(!$plan)
            return redirect()->back();

        if($plan->details->count() > 0)
        return redirect()->back()
                         ->with('error', 'Não pode deletar esse plano existe detalhes relacionados a ele');    

        $plan->delete();

        return redirect()->route('plans.index');
    }
    //filtra um plano pelo nome e pela descrição
    public function search(Request $request)
    {
        $plans = $this->repository->search($request->filter);

        return view('admin.pages.plans.index',[
            'plans' => $plans,
        ]);
    }
    // view do edit
    public function edit($url)
    {
        if(!$plan = $this->repository->where('url', $url)->first())
            return redirect()->back();

            return view('admin.pages.plans.edit',[
                'plan' => $plan]);   
    }
    //fazer a edição e persistir os dados
    public function update(StoreUpdatePlan $request, $url)
    {

        if(!$plan = $this->repository->where('url', $url)->first())
            return redirect()->back();

        $plan->update($request->all());

            return redirect()->route('plans.index');
    }
}
