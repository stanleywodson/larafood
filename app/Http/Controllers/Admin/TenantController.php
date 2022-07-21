<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index()
    {
        echo 'estou no index';
    }

    public function edit($id)
    {
        echo 'edit'.$id;
    }

    public function update($id)
    {
        echo 'atualizei'.$id;
    }
}
