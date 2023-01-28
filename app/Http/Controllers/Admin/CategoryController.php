<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return view('auth.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.categories.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
	{
		$path = $request->file('image')->store('categories'); // Получаем путь к файлу, который был создан. 'image' - название поля (поля ввода), 'categories' - папка, в которую сохраняем.
		$params = $request->all(); // Берем все параметры, которые получили
		$params['image'] = $path; // В БД в таблице categories в поле images сохраняется путь к файлу. Сам файл в storage\app\categories. Папка categories создается автоматически (в структуре проекта)
		Category::create($params);
		return to_route('categories.index');
	}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('auth.categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('auth.categories.form', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
	{
		if($category->image) {
            Storage::delete($category->image); // Удаляем старую картинку
        }
		$path = $request->file('image')->store('categories');
		$params = $request->all();
		$params['image'] = $path;
		$category->update($params);
		return to_route('categories.index');
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->image) {
			Storage::delete($category->image); // Удаляем старую картинку
		}
        $category->delete();
        return to_route('categories.index');
    }
}
