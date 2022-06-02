<?php

namespace App\Http\Controllers\ACL;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProfiles;

class PermissionController extends Controller
{
    protected $repository;
    
    public function __construct(Permission $permission)
    {
        $this->repository = $permission;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission = $this->repository->all();

        return view('admin.pages.permission.index', compact('permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProfiles $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('permission.index')
                         ->with('success', 'Perfil criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = $this->repository->where('id', $id)->first();
        
        if(!$permission)
            return redirect()->back();

        return view('admin.pages.permission.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = $this->repository->where('id', $id)->first();

        if(!$permission)
            return redirect()->back();

        return view('admin.pages.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProfiles $request, $id)
    {
        $permission = $this->repository->where('id', $id)->first();

        if(!$permission)
            return redirect()->back();

        $permission->update($request->all());

        return redirect()->route('permission.index')->with('update','Atualizado com sucesso!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = $this->repository->where('id', $id)->first();
        if(!$permission)
            return redirect()->back();

        $permission->delete();
        return redirect()->route('permission.index')->with('delete', 'Deletado com sucesso!');
    }
}
