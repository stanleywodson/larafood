<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategory;

class CategoryController extends Controller
{
    private object $repository;

    public function __construct(Category $category)
    {
        $this->repository = $category;
        $this->middleware('can:categories');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$categories = $this->repository->get())
            return redirect()->route('categories.index');


        return view('admin.pages.categories.index', compact('categories'));
    }

    public function search(Request $request)
    {
        $categories = $this->repository->search($request->filter);

        return view('admin.pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCategory $request)
    {
        //$data = $request->all();
        //$data['tenant_id'] = auth()->user()->tenant_id; //consigo trazer o id do tenant - porque o usuário logado tem relaciomento com o tenant

        $category = $this->repository->create($request->all());
        if(!$category){
                return redirect()->route('categories.index')->with('error', 'Algo deu errado, tente novamente!');
        }else{
            return redirect()->back()->with('success', 'Cadastrado com sucesso!');
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
        if(!$category = $this->repository->find($id))
        //usa se o first para trazer um unico resultado ao colocar get() tenta trazer uma cellection
        return redirect()->back();

        return view('admin.pages.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$category = $this->repository->find($id))
            return redirect()->back();

        return view('admin.pages.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCategory $request, $id)
    {
        if(!$category = $this->repository->find($id))
            return redirect()->back();

            $category->update($request->all());
            return redirect()->route('categories.index')->with('update', 'Atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$category = $this->repository->find($id))
        return redirect()->back();

        $category->delete();
        return redirect()->route('categories.index')->with('delete', 'Deletado com sucesso!');
    }
}
