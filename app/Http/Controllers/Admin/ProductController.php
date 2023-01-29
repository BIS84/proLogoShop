<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
	return view('auth.products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('auth.products.form', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
	{
		$params = $request->all();
		unset($params['image']);
		if ($request->has('image')) {
			$path = $request->file('image')->store('products');
			$params['image'] = $path;
        }

		Product::create($params);
		return to_route('products.index');
	}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('auth.products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        return view('auth.products.form', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
	{
		$params = $request->all();
		unset($params['image']);
		if ($request->has('image')) {
			Storage::delete($product->image);
			$path = $request->file('image')->store('products');
			$params['image'] = $path;
		}

        foreach (['new', 'hit', 'recommend'] as $fieldName) {
			if (!isset($params[$fieldName])) { // Если параметр не существует, передаем 0
				$params[$fieldName] = 0;
			}
		}

		$product->update($params);
		return to_route('products.index');
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
	{
		if ($product->image) {
		Storage::delete($product->image);
        }
		$product->delete();
		return to_route('products.index');
	}
}
