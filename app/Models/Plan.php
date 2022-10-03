<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'url', 'price', 'description'];

    public function search($filter)
    {
        if ($filter){
        $results = $this->where('name', 'LIKE', "%{$filter}%")->get();

        return $results;
        }
    }

    public function permissionsAvailable()
    {
        $profiles = Profile::whereNotIn('profiles.id', function($query) {
            $query->select('plan_profile.profile_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.plan_id={$this->id}");
        })->get();

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
