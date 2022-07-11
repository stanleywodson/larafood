<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Http\Requests\StoreUpdateTable;

class TableController extends Controller
{
    private object $repository;

    public function __construct(Table $table)
    {
        $this->repository = $table;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$tables = $this->repository->get())
            return redirect()->route('plans.index');


        return view('admin.pages.tables.index', compact('tables'));
    }

    public function search(Request $request)
    {
        $tables = $this->repository->search($request->filter);

        return view('admin.pages.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTable $request)
    {
        //$data = $request->all();
        //$data['tenant_id'] = auth()->user()->tenant_id; //consigo trazer o id do tenant - porque o usuário logado tem relaciomento com o tenant

        $table = $this->repository->create($request->all());
        if(!$table){
            return redirect()->route('tables.index')->with('error', 'Algo deu errado, tente novamente!');
        }else{
            return redirect()->route('tables.index')->with('success', 'Cadastrado com sucesso!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        if(!$table = $this->repository->find($id))
            //usa se o first para trazer um unico resultado ao colocar get() tenta trazer uma cellection
            return redirect()->back();

        return view('admin.pages.tables.show', compact('table'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$table = $this->repository->find($id))
            return redirect()->back();

        return view('admin.pages.tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTable $request, $id)
    {
        if(!$table = $this->repository->find($id))
            return redirect()->back();

        $table->update($request->all());
        return redirect()->route('tables.index')->with('update', 'Atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$table = $this->repository->find($id))
            return redirect()->back();

        $table->delete();
        return redirect()->route('tables.index')->with('delete', 'Deletado com sucesso!');
    }
}
