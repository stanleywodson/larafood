<?php

namespace App\Http\Controllers\Admin\ACL;

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

    public function search(Request $request)
    {
        $profiles = $this->repository->search($request->filter);

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
        if(!$profile = $this->repository->where('id', $id)->first())
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
        if(!$profile = $this->repository->where('id', $id)->first())
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
        if(!$profile = $this->repository->where('id', $id)->first())
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
        if(!$profile = $this->repository->where('id', $id)->first())
            return redirect()->back();

        $profile->delete();
        return redirect()->route('profiles.index')->with('delete', 'Deletado com sucesso!');
    }
}