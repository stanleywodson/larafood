<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Cargo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCargos;
use PDF;

class CargoController extends Controller
{
    protected $repository;

    public function __construct(Cargo $cargo)
    {
        $this->repository = $cargo;
        $this->middleware('can:cargos');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos = $this->repository->all();

        return view('admin.pages.cargos.index', compact('cargos'));
    }

    public function pdf()
    {
        $cargos = $this->repository->all();

        $pdf = PDF::loadView('admin.pages.cargos.pdf', compact('cargos'));
        return $pdf->stream();

        //return view('admin.pages.cargos.pdf', compact('cargos'));
    }

    public function search(Request $request)
    {
        $cargos = $this->repository->search($request->filter);

        return view('admin.pages.cargos.index', compact('cargos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.cargos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCargos $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('cargos.index')
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
        //$teste = $this->repository->findOrFail($id);

        if(!$cargo = $this->repository->where('id', $id)->first())
            return redirect()->back();

        return view('admin.pages.cargos.show', compact('cargo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$cargo = $this->repository->where('id', $id)->first())
            return redirect()->back();

        return view('admin.pages.cargos.edit', compact('cargo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCargos $request, $id)
    {
        if(!$cargo = $this->repository->where('id', $id)->first())
            return redirect()->back();

        $cargo->update($request->all());

        return redirect()->route('cargos.index')->with('update','Atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$cargo = $this->repository->where('id', $id)->first())
            return redirect()->back();

        $cargo->delete();
        return redirect()->route('cargos.index')->with('delete', 'Deletado com sucesso!');
    }
}

