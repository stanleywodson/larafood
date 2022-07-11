<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Tenant\Traits\TenantTrait;

class Table extends Model
{
    use HasFactory;
    use TenantTrait;

    protected $fillable = ['identity', 'description'];
}
