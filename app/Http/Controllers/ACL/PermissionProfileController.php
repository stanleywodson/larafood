<?php

namespace App\Http\Controllers\ACL;

use App\Models\Profile;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;

class PermissionProfileController extends Controller
{
    protected $profile;
    protected $permission;
    public function __construct(Permission $permission,Profile $profile)
    {
        $this->profile = $profile;
        $this->permission = $permission;
    }

    public function permissions($idProfile)
    {
        $profile = $this->profile->with('permissions')->find($idProfile);
        if(!$profile)
            return redirect()->back();
            
            //posso recuperar esse mesmo resultado na variavel profile fazendo um foreach.
            $permissions = $profile->permissions;
            
        return view('admin.pages.profiles.permissions.permissions', compact('profile', 'permissions'));

    }

    public function permissionsAvailable($idProfile)
    {
        if(!$profile = $this->profile->find($idProfile))
            return redirect()->back();
        
        $permissions = $profile->permissionsAvailable();
        //$permissions = $this->permission::all();

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions'));
    }

    //store do permissionsAvailable
    public function attachPermissionProfile(Request $request, $idProfile)
    {
        if(!$profile = $this->profile->with('permissions')->find($idProfile))
        return redirect()->back();

        if(!$request->permissions || count($request->permissions) == 0){
            return redirect()->back()->with('error', 'Checkbox vazio');
        }

        $profile->permissions()->attach($request->permissions);
        return redirect()->route('profiles.permissions', $profile->id)->with('permissions', 'Viculado com sucesso!');
    }
}
