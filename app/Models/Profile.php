<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'description'];
    
    public function search($filter)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
                        ->orWhere('description', 'LIKE', "%{$filter}%")
                        ->get();

        return $results;
    }
    /**
     * Relationship ManyToMany,um perfil pertence a muitas permissões N:N
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    /**
     * um perfil pertence a muitos planos N:N
     */
    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }
    
    public function permissionsAvailable()
    {
        $permissions = Permission::whereNotIn('permissions.id', function($query) {
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id={$this->id}");
        });
        
        return $permissions;
    }
}
