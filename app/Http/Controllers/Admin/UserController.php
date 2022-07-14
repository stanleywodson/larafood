<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUsers;
use Illuminate\Support\Facades\Hash;

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
        //tenantUser refere-se ao escopo nao ao relacionamento ambos estão no model user
        $users = $this->repository->get();
        //$users = $this->repository->where('tenant_id', auth()->user()->tenant_id)->get(); //forma que traz o mesmo resultado de exemplo de cima

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
        $data['password'] = Hash::make($data['password']);

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
    public function show(int $id)
    {
        if(!$user = $this->repository->tenantUser()->with('tenant')->where('id', $id)->first())
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
        if(!$user = $this->repository->tenantUser()->where('id', $id)->first())
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
    public function update(StoreUpdateusers $request, int $id)
    {
        if(!$user = $this->repository->tenantUser()->where('id', $id)->first())
            return redirect()->back();

        $data = $request->only('name');

        if($request->password){
            $data['password'] = Hash::make($request->password);

        }
        $user->update($data);

        return redirect()->route('users.index')->with('update','Atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        if(!$user = $this->repository->tenantUser()->where('id', $id)->first())
            return redirect()->back();

        $user->delete();
        return redirect()->route('users.index')->with('delete', 'Deletado com sucesso!');
    }
}
