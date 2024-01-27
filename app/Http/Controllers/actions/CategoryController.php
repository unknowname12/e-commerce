<?php

namespace App\Http\Controllers\actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()->latest()->paginate(3);
        return view('categories.index', compact('categories'));
    }
    public function create()
    {
        return view('categories.create');
    }
    public function edit(string $slug)
    {
        $category = Category::query()->where('slug', $slug)->firstOrFail();
        return view('categories.edit', compact('category'));
    }

    public function show(string $slug)
    {
        $categories = Category::query()->latest()->get();
        $category = Category::query()->where('slug', $slug)->firstOrFail();
        $products = Product::query()->where('category_id', $category->id)->latest()->paginate(6);
        return view('categories.show', compact(['categories','products', 'category']));
    }
    public function store(CategoryRequest $request)
    {
        $category = new Category();
        $category->title = $request->input('title');
        $category->user_id = $request->user()->id;
        $category->save();
        noty()->addSuccess('Kamu berhasil membuat category baru!');
        return Redirect::route('category.index');
    }

    public function update(string $slug, CategoryRequest $request)
    {
        $category = Category::query()->where('slug', $slug)->firstOrFail();
        $category->update($request->all());
        noty()->addSuccess('Kamu berhasil memperbaruhi category!');
        return Redirect::route('category.edit', $category->slug);
    }

    public function destroy(string $slug)
    {
        $category = Category::query()->where('slug', $slug)->firstOrFail();
        $category->delete();
        noty()->addSuccess('Kamu berhasil menghapus category!');
        return Redirect::back();
    }
}
