<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    protected $category;
    protected $product;

    public function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }
    //metodo retorna todas as Categorias de determinado Produto
    public function categories($productId)
    {
        $product = $this->product->with('categories')->find($productId);

        return view('admin.pages.products.categories.categories', compact('product'));
    }
    //metodo retorna todas os Produtos de determinada Categoria
    public function products($categoryId)
    {
        $category = $this->category->with('products')->find($categoryId);

        return view('admin.pages.categories.products.products', compact('category'));
    }

    public function detachProductCategory($categoryId, $productId)
    {
        $product = $this->product->find($productId);

        $category = $this->category->find($categoryId);

        if (!$product || !$category)
            return redirect()->back();

        $category->products()->detach($productId);
        return redirect()->route('categories.products', $category->id);
    }

}
