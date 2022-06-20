<?php

namespace App\Models;

use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    public function search($filter)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
        ->orWhere('name', 'LIKE', "%{$filter}%")
        ->orWhere('email', 'LIKE', "%{$filter}%")
        ->get();

    return $results;
    }
    /**
     * um tenant tem um usuário
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
