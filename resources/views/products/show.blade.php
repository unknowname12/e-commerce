<x-layouts.main title="Show">
    <div class="flex justify-center items-center min-h-screen">

        <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-end px-4 pt-4">
                @if(Auth::check())
                <button id="dropdownButton" data-dropdown-toggle="dropdown" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg text-sm p-1.5" type="button">
                    <span class="sr-only">Open dropdown</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                        <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                    </svg>
                </button>
                <div id="dropdown" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2" aria-labelledby="dropdownButton">
                        <li>
                            <a href="{{ route('product.edit', $product->slug) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                        </li>
                        <li>
                            <form action="{{ route('product.destroy', $product->slug) }}" method="post" class="hidden" id="delete-{{$product->slug}}">@csrf @method('DELETE')</form>
                            <button class="text-start w-full block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" form="delete-{{$product->slug}}">Delete</button>
                        </li>
                    </ul>
                </div>
                @endif
            </div>
            <div class="flex flex-col items-center pb-10">
                <div class="flex flex-col gap-1 justify-center items-center w-full">
                    <img title="Images" id="preview" class="h-[200px] w-[300px] object-cover rounded-lg border-2" src="{{ $product->images != null ? \Illuminate\Support\Facades\Storage::url('images/' . $product->images) : 'https://placehold.co/200x300' }}" alt="Images" />
                </div>
                <h5 class="my-[1rem] text-xl font-medium text-gray-900 dark:text-white">{{ $product->title }}</h5>
                <div class="flex flex-row justify-center items-center gap-5 mb-1">
                    @if($product->category_id != null)
                        <a href="{{ route('category.show', $product->category->slug) }}" class=" whitespace-nowrap bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{ $product->category->title }}</a>
                    @else
                        <span class="text-center text-xs font-medium border px-2.5 py-0.5 rounded whitespace-nowrap">Category Tidak Ada</span>
                    @endif
                    <span class="whitespace-nowrap text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2 border">
                          <svg class="w-2.5 h-2.5 mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                          </svg>
                          {{ $product->updated_at->diffForHumans() }}
                    </span>
                </div>
                <span class="text-xl font-semibold my-[1rem]">{{ $product->getPriceByFormat() }}</span>
                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $product->user->name }}</span>
                <div class="flex mt-4 space-x-3 md:mt-6">
                    <form method="post" action="{{ route('cart.store') }}" id="cart-{{$product->slug}}">
                        @csrf
                        <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="name" id="name" value="{{ $product->title }}">
                        <input type="hidden" name="price" id="price" value="{{ $product->price }}">
                        <input type="hidden" name="qyt" id="qyt" value="1">
                        <button type="submit" title="Added to Cart" class="p-[.5rem] rounded-full bg-gray-200/50 border hover:text-yellow-600 transition-all" form="cart-{{$product->slug}}">
                            <svg class="w-[20px] h-[20px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 19 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm1-4H5m0 0L3 4m0 0h5.501M3 4l-.792-3H1m11 3h6m-3 3V1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>
