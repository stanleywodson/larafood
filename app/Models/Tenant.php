<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_id', 'cnpj', 'name', 'url', 'email', 'logo', 'active',
        'subscription', 'expires_at', 'subscription_id', 'subscription_active', 
        'subscription_suspended',
    ];
    // uma empresa tem varios usuários 1:N
    public function users()
    {
        return $this->hasMany(User::class);
    }
    //um plano pertence a uma empresa 
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
