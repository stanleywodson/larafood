<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $repository;
    
    public function __construct(User $user)
    {
        $this->repository = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository->all();

        return view('admin.pages.users.index', compact('users'));
    }

    public function search(Request $request)
    {
        $users = $this->repository->search($request->filter);

        return view('admin.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateusers $request)
    {
        $data = $request->all();
        $data['tenant_id'] = auth()->user()->tenant->id;

        $this->repository->create($data);

        return redirect()->route('users.index')
                         ->with('success', 'Usuário criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {     
        if(!$user = $this->repository->where('id', $id)->first())
            return redirect()->back();

        return view('admin.pages.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$user = $this->repository->where('id', $id)->first())
            return redirect()->back();

        return view('admin.pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateusers $request, $id)
    {
        if(!$user = $this->repository->where('id', $id)->first())
            return redirect()->back();

        $user->update($request->all());

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
        if(!$user = $this->repository->where('id', $id)->first())
            return redirect()->back();

        $user->delete();
        return redirect()->route('users.index')->with('delete', 'Deletado com sucesso!');
    }
}
