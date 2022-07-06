<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Profile;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionProfileController extends Controller
{
    protected $profile;
    protected $permission;
    public function __construct(Permission $permission, Profile $profile)
    {
        $this->profile = $profile;
        $this->permission = $permission;
    }

    public function permissions($idProfile)
    {
        if (!$profile = $this->profile->with('permissions')->find($idProfile))
            return redirect()->back();

        //posso recuperar esse mesmo resultado na variavel profile fazendo um foreach.
        $permissions = $profile->permissions;

        return view('admin.pages.profiles.permissions.permissions', compact('profile', 'permissions'));
    }
    // mostrar perfis vinculados a permissoes
    public function profiles($idPermission)
    {
        if (!$permissions = $this->permission->with('profiles')->find($idPermission))
            return redirect()->back();

        return view('admin.pages.permission.profiles.profiles', compact('permissions'));
    }

    public function permissionsAvailable($idProfile)
    {
        if (!$profile = $this->profile->find($idProfile))
            return redirect()->back();

         $permissions = $profile->permissionsAvailable();

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions'));
    }

    //vincular uma ou mais  permissões a certo perfil
    public function attachPermissionProfile(Request $request, $idProfile)
    {
        if (!$profile = $this->profile->with('permissions')->find($idProfile))
            return redirect()->back();

        if (!$request->permissions || count($request->permissions) == 0) {
            return redirect()->back()->with('error', 'Checkbox vazio');
        }

        $profile->permissions()->attach($request->permissions);
        return redirect()->route('profiles.permissions', $profile->id)->with('permissions', 'Viculado com sucesso!');
    }
    //desvincular uma ou mais permissões ao perfis
    public function detachPermissionProfile($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);

        $permission = $this->permission->find($idPermission);

        if (!$profile || !$permission)
            return redirect()->back();

        $profile->permissions()->detach($permission);
        return redirect()->route('profiles.permissions', $profile->id);
    }
}
