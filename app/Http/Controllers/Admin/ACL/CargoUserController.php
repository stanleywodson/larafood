<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\User;
use Illuminate\Http\Request;

class CargoUserController extends Controller
{
    protected $user, $cargo;

    public function __construct(User $user, Cargo $cargo)
    {
        $this->user = $user;
        $this->cargo = $cargo;
    }

    public function cargos($userId)
    {
        //essa função vai trazer os usuários com seus cargos relacioandos para listar numa view "todos os cargos relacionados"
        if(!$user = $this->user->with('cargos')->find($userId))
            return redirect()->back();

        return view('admin.pages.users.cargos.cargos', compact('user'));
    }

//    public function user($cargoId)
//    {
//        //trás o cargo e todos os usuários que estão relacionados a ele
//        $cargo = $this->cargo->with('users')->find($cargoId);
//    }

    public function cargosAttach($userId)
    {
        $user = $this->user->find($userId);
        $teste = $user->cargosAttach();
        dd($teste);
    }
}
