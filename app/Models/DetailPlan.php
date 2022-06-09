<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPlan extends Model
{
    use HasFactory;

    protected $table = 'details_plan';
    protected $fillable = ['name'];
    

    //detalhe pertence a um plano -- 1:1
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
