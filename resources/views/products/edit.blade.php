<x-layouts.main title="Edit">
    <div class="min-h-screen w-full mx-auto">
        <div class="block p-6 bg-white border border-gray-200 rounded-lg bg-gray-300/20">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Edit Product - {{ $product->title }}</h5>
            <hr class="my-[1rem]">
            <form method="post" action="{{ route('product.update', $product->slug)  }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="flex flex-col gap-3">
                    <div class="flex flex-col gap-1 justify-center items-center w-full">
                        <img title="Images" id="preview" class="border h-[200px] w-[300px] object-cover rounded-lg" src="{{ $product->images != null ? \Illuminate\Support\Facades\Storage::url('images/' . $product->images) : 'https://placehold.co/200x300' }}" alt="Images" />
                    </div>
                    <div class="flex flex-col gap-1 justify-start items-start w-full">
                        <label for="images">Image:</label>
                        <input onchange="previews(event)" class="w-full border-gray-300 bg-gray-200/60 rounded-lg" placeholder="Product Title" type="file" name="images" id="images">
                        <x-error :messages="$errors->get('images')"/>
                    </div>
                    <div class="flex flex-col gap-1 justify-start items-start w-full">
                        <label for="title">Title:</label>
                        <input class="w-full border-gray-300 bg-gray-200/60 rounded-lg" placeholder="Product Title" type="text" name="title" id="title" value="{{ old('title', $product->title) }}">
                        <x-error :messages="$errors->get('title')"/>
                    </div>
                    <div class="flex flex-col gap-1 justify-start items-start w-full">
                        <label for="price">Price:</label>
                        <input class="w-full border-gray-300 bg-gray-200/60 rounded-lg" placeholder="Product Price" type="number" min="5000" name="price" id="price" value="{{ old('price', $product->price) }}">
                        <x-error :messages="$errors->get('price')"/>
                    </div>
                    <div class="flex flex-col gap-1 justify-start items-start w-full">
                        <label for="category_id">Select an category</label>
                        <select id="category_id" name="category_id" class="w-full border-gray-300 bg-gray-200/60 rounded-lg">
                            <option selected>Choose a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $product->category->id) == $category->id)>{{ $category->title }}</option>
                            @endforeach
                        </select>
                        <x-error :messages="$errors->get('category_id')"/>
                    </div>
                    <div class="w-full md:w-auto">
                        <button type="submit" class="text-white bg-gray-700 hover:bg-gray-800 font-medium rounded-lg text-sm p-3">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        const previews = function (event) {
            const output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
</x-layouts.main>
