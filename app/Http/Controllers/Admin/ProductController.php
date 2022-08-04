<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProduct;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Session\Store;


class ProductController extends Controller
{

    private object $repository;

    public function __construct(Product $product)
    {
        $this->repository = $product;
        $this->middleware('can:products');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$products = $this->repository->get())
            return redirect()->route('products.index');


        return view('admin.pages.products.index', compact('products'));
    }

    public function search(Request $request)
    {
        $products = $this->repository->search($request->filter);

        return view('admin.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //retorna todas as categorias onde os produtos seram inseridos
        $categories = Category::all();

        return view('admin.pages.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProduct $request)
    {
        //dd($request->categories);

        $data = $request->all();
        $tenant = auth()->user()->tenant;

        if($request->hasFile('image') && $request->image->isValid()){
            $data['image'] = $request->image->store("tenants/{$tenant->uuid}/produts");
        }

        if (!$request->categories || count($request->categories) == 0) {
            dd('entrou aqui');
            //return redirect()->back()->with('error', 'Checkbox vazio');
        }
        $product = $this->repository->create($data);
        $category = $product->categories()->attach($data['categories']);






        if(!$product){
            return redirect()->route('products.index')->with('error', 'Algo deu errado, tente novamente!');
        }else{
            return redirect()->route('products.index')->with('success', 'Cadastrado com sucesso!');
        }

    }
    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$product = $this->repository->find($id))
            //usa se o first para trazer um unico resultado ao colocar get() tenta trazer uma cellection
            return redirect()->back();

        return view('admin.pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$product = $this->repository->find($id))
            return redirect()->back();
        $categories = $product->categoriesAvailable();

        return view('admin.pages.products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProduct $request, $id)
    {
        if(!$product = $this->repository->find($id))
            return redirect()->back();

        $data = $request->all();

        $tenant = auth()->user()->tenant;

        if($request->hasFile('image') && $request->image->isValid()){
            //deleta o arquivo de imagem caso ele exista
            if(Storage::exists($product->image)){
                Storage::delete($product->image);
            }

            $data['image'] = $request->image->store("tenants/{$tenant->uuid}/produts");
        }


        if (!$request->categories || count($request->categories) == 0) {
            return redirect()->back()->with('error', 'Checkbox vazio');
        }

        $product->update($data);
        $category = $product->categories()->attach($data['categories']);

        return redirect()->route('products.index')->with('update', 'Atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$product = $this->repository->find($id))
            return redirect()->back();

        if(Storage::exists($product->image)){
            Storage::delete($product->image);
        }

        $product->delete();
        return redirect()->route('products.index')->with('delete', 'Deletado com sucesso!');
    }
}
