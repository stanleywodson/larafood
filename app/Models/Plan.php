<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Plan extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'url', 'price', 'description'];

    public function search($filter)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
                        ->orWhere('description', 'LIKE', "%{$filter}%")
                        ->get();

        return $results;
    }

    public function permissionsAvailable()
    {
        $plan_profile = DB::table('plan_profile')->select('plan_profile.profile_id')->whereRaw("plan_profile.plan_id={$this->id}");

        $profiles = Profile::whereNotIn('profiles.id', $plan_profile);
        
        // $profiles = Profile::whereNotIn('profiles.id', function($query) {
        //     $query->select('plan_profile.profile_id');
        //     $query->from('plan_profile');
        //     $query->whereRaw("plan_profile.plan_id={$this->id}");
        // });
        return $profiles;
    }

    // um plano tem muitos detalhes 1:N
    public function details(){
        return $this->hasMany(DetailPlan::class);
    }
    // um plano tem muitos perfis N:N
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
    // um plano tem muitas empresas 1:N
    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }

    
}
