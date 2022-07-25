<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Cargo;
use App\Models\Profile;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionCargoController extends Controller
{
    protected $cargo;
    protected $permission;

    public function __construct(Permission $permission, Cargo $cargo)
    {
        $this->cargo = $cargo;
        $this->permission = $permission;
        $this->middleware('can:permissions');
    }

    public function permissions($idCargo)
    {
        if (!$cargo = $this->cargo->with('permissions')->find($idCargo))
            return redirect()->back();

        //posso recuperar esse mesmo resultado na variavel cargo fazendo um foreach.
        $permissions = $cargo->permissions;

        return view('admin.pages.cargos.permissions.permissions', compact('cargo', 'permissions'));
    }
    // mostrar perfis vinculados a permissoes
    public function cargos($idPermission)
    {
        if (!$permissions = $this->permission->with('cargos')->find($idPermission))
            return redirect()->back();

        return view('admin.pages.permission.cargos.cargos', compact('permissions'));
    }

    public function permissionsAvailable($idCargo)
    {
        if (!$cargo = $this->cargo->find($idCargo))
            return redirect()->back();

        $permissions = $cargo->permissionsAvailable();

        return view('admin.pages.cargos.permissions.available', compact('cargo', 'permissions'));
    }

    //vincular uma ou mais  permissões a certo perfil
    public function attachPermissionProfile(Request $request, $idCargo)
    {
        if (!$cargo = $this->cargo->with('permissions')->find($idCargo))
            return redirect()->back();

        if (!$request->permissions || count($request->permissions) == 0) {
            return redirect()->back()->with('error', 'Checkbox vazio');
        }

        $cargo->permissions()->attach($request->permissions);
        return redirect()->route('cargos.permissions', $cargo->id)->with('permissions', 'Viculado com sucesso!');
    }
    //desvincular uma ou mais permissões ao perfis
    public function detachPermissionProfile($idCargo, $idPermission)
    {
        $cargo = $this->cargo->find($idCargo);

        $permission = $this->permission->find($idPermission);

        if (!$cargo || !$permission)
            return redirect()->back();

        $cargo->permissions()->detach($permission);
        return redirect()->route('cargos.permissions', $cargo->id);
    }
}
