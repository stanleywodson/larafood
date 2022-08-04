<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
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

    //vai trazer as permissiões que nao estão vinculadas ao cargo
    public function permissionsAvailable()
    {
        $permissions = Permission::whereNotIn('permissions.id', function($query) {
            $query->select('cargo_permission.permission_id');
            $query->from('cargo_permission');
            $query->whereRaw("cargo_permission.cargo_id={$this->id}");
        })->get();

        return $permissions;
    }
    // um cargo tem muitas permissões
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    // um cargo tem muitos usuários
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
