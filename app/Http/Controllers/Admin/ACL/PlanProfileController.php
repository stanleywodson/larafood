<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanProfileController extends Controller
{
    protected $profile;
    protected $plan;
    public function __construct(Plan $plan, Profile $profile)
    {
        $this->profile = $profile;
        $this->plan = $plan;
    }

    public function profiles($idPlan)
    {
        if (!$plan = $this->plan->find($idPlan))
            return redirect()->back();

        //posso recuperar esse mesmo resultado na variavel profile fazendo um foreach.
        $profiles = $plan->profiles;

        return view('admin.pages.plans.profiles.profiles', compact('profiles', 'plan'));
    }
    //mostrar perfis vinculados a permissoes
    public function plans($idProfile)
    {
        if (!$profiles = $this->profile->with('plans')->find($idProfile))
            return redirect()->back();

        return view('admin.pages.profiles.plans.plans', compact('profiles'));
    }

    public function permissionsAvailable($idPlan)
    {
        if (!$plan = $this->plan->find($idPlan))
            return redirect()->back();
        //$profiles = $plan->permissionsAvailable();
        $profiles = $this->profile::all();
        return view('admin.pages.plans.profiles.available', compact('profiles', 'plan'));
    }

    //vincular uma perfil ao plano
    public function attachPermissionProfile(Request $request, $idPlan)
    {
        if (!$plan = $this->plan->find($idPlan))
            return redirect()->back();


        if (!$request->profiles || count($request->profiles) == 0) {
            return redirect()->back()->with('error', 'Checkbox vazio');
        }

        $plan->profiles()->attach($request->profiles);
        return redirect()->route('plans.profiles', $plan->id)->with('permissions', 'Viculado com sucesso!');
    }
    // //desvincular perfil ao plano
    public function detachPermissionProfile($idPlan, $idProfile)
    {
        $profile = $this->profile->find($idProfile);

        $plan = $this->plan->find($idPlan);

        if (!$profile || !$plan)
            return redirect()->back();

        $plan->profiles()->detach($profile);
        return redirect()->route('plans.profiles', $plan->id);
    }
}

