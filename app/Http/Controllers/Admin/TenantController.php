<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index()
    {
        echo '<h1>Página em construção</h1>';
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
