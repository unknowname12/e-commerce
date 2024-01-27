<?php

namespace App\Http\Controllers\actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class ProductController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');
        $products = Product::query()->where('title', 'LIKE' ,  "%{$search}%")->latest()->paginate(6);
        $categories = Category::query()->latest()->get();
        return view('products.index', compact(['products', 'categories']));
    }

    public function index()
    {
        $products = Product::query()->latest()->paginate(6);
        $categories = Category::query()->latest()->get();
        return view('products.index', compact(['products', 'categories']));
    }

    public function create()
    {
        $categories = Category::query()->latest()->get()->all();
        return view('products.create', compact('categories'));
    }

    public function edit(string $slug)
    {
        $product = Product::query()->where('slug', $slug)->firstOrFail();
        $categories = Category::query()->latest()->get()->all();
        return view('products.edit', compact(['categories', 'product']));
    }

    public function show(string $slug)
    {
        $product = Product::query()->where('slug', $slug)->firstOrFail();
        return view('products.show', compact('product'));
    }

    public function store(ProductRequest $request)
    {
        $images_path = null;

        if ($request->hasFile('images')){
            $images = $request->file('images');
            $images_path = Str::random(10) . '-images.webp';
            $manager = new ImageManager();
            $image = $manager->make($images->getRealPath());
            $image->save('storage/images/' . $images_path);
        }

        $product = new Product();
        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->user_id = $request->user()->id;
        $product->images = $images_path;

        $product->save();
        noty()->addSuccess('Kamu berhasil membuat product baru!');
        return Redirect::route('product.index');
    }

    public function update(string $slug, ProductRequest $request)
    {
        $product = Product::query()->where('slug', $slug)->firstOrFail();

        $images_path = $product->images;

        if ($request->hasFile('images')){
            File::delete(public_path('storage/images/' . $product->images));
            $images = $request->file('images');
            $images_path = Str::random(10) . '-images.webp';
            $manager = new ImageManager();
            $image = $manager->make($images->getRealPath());
            $image->save('storage/images/' . $images_path);
        }

        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->user_id = $request->user()->id;
        $product->images = $images_path;
        $product->update();

        noty()->addSuccess('Kamu berhasil memperbaruhi product!');
        return Redirect::route('product.edit', $product->slug);
    }

    public function destroy(string $slug)
    {
        $product = Product::query()->where('slug', $slug)->firstOrFail();
        File::delete(public_path('storage/images/' . $product->images));
        $product->delete();
        noty()->addSuccess('Kamu berhasil menghapus product!');
        return Redirect::route('product.index');
    }
}
