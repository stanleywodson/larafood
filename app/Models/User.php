<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Traits\UserACLTrait;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UserACLTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tenant_id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
        /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTenantUser(Builder $query)
    {
        return $query->where('tenant_id', auth()->user()->tenant_id);
    }

    public function search($filter)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
        ->orWhere('email', 'LIKE', "%{$filter}%")
        ->tenantUser()
        ->get();

    return $results;
    }
    public function cargosAttach()
    {
        $cargos = Cargo::whereNotIn('cargos.id', function ($query){
            $query->select('cargo_user.cargo_id');
            $query->from('cargo_user');
            $query->whereRaw("cargo_user.user_id={$this->id}");
        })->get();

        return $cargos;
    }


    /**
     * um tenant pertence a um usuário
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
    public function cargos()
    {
        return $this->belongsToMany(Cargo::class);
    }
}
