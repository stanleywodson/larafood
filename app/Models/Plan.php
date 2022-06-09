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
        $results = $this->where('name', 'LIKE', "%{$filter}%")
                        ->orWhere('description', 'LIKE', "%{$filter}%")
                        ->get();

        return $results;
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

    public function tenantis()
    {
        return $this->hasMany(Tenant::class);
    }

    public function permissionsAvailable()
    {
        $profiles = Profile::whereNotIn('profiles.id', function($query) {
            $query->select('plan_profile.profile_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.plan_id={$this->id}");
        });
        return $profiles;
    }
    
}
