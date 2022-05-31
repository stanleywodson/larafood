<?php

namespace App\Http\Controllers\ACL;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProfiles;

class ProfileController extends Controller
{
    protected $repository;
    
    public function __construct(Profile $profile)
    {
        $this->repository = $profile;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = $this->repository->all();

        return view('admin.pages.profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.profiles.create');
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

        return redirect()->route('profiles.index')
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
        $profile = $this->repository->where('id', $id)->first();
        
        if(!$profile)
            return redirect()->back();

        return view('admin.pages.profiles.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = $this->repository->where('id', $id)->first();

        if(!$profile)
            return redirect()->back();

        return view('admin.pages.profiles.edit', compact('profile'));
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
        $profile = $this->repository->where('id', $id)->first();

        if(!$profile)
            return redirect()->back();

        $profile->update($request->all());

        return redirect()->back()->with('update','Atualizado com sucesso!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = $this->repository->where('id', $id)->first();
        if(!$profile)
            return redirect()->back();

        $profile->delete();
        return redirect()->route('profiles.index')->with('delete', 'Deletado com sucesso!');
    }
}