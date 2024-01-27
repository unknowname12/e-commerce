@props(['products'])

<div class="{{ $products->count() <= 0 ? 'inline-flex justify-center items-center' : 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4' }} w-full">
    @forelse($products as $product)
        <div class="flex flex-col justify-between items-start gap-[1.4rem] p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <div class="flex flex-col gap-1 justify-center items-center w-full">
                <img title="Images" id="preview" class="h-[200px] w-[300px] object-cover rounded-lg border-2" src="{{ $product->images != null ? \Illuminate\Support\Facades\Storage::url('images/' . $product->images) : 'https://placehold.co/200x300' }}" alt="Images" />
            </div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 whitespace-nowrap">{{ \Illuminate\Support\Str::limit($product->title, 20, "..") }}</h5>
            @if($product->category_id != null)
                @if($product->category != null)
                    <a href="{{ route('category.show', $product->category->slug) }}" class="whitespace-nowrap bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{ $product->category->title }}</a>
                @else
                    <span class="text-center text-xs font-medium border px-2.5 py-0.5 rounded mr-2 whitespace-nowrap">Null - Category Dihapus</span>
                @endif
            @else
                <span class="text-center text-xs font-medium border px-2.5 py-0.5 rounded mr-2 whitespace-nowrap">Categorys Tidak Ada</span>
            @endif
            <div class="flex flex-row justify-between w-full items-center whitespace-nowrap">
                <p class="font-normal text-gray-700 dark:text-gray-400 whitespace-nowrap">{{ $product->getPriceByFormat($product->price) }}</p>
                <span class="text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2 border">
                  <svg class="w-2.5 h-2.5 mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                  </svg>
                  {{ $product->updated_at->diffForHumans() }}
                </span>
            </div>
            <div class="flex flex-row justify-start items-center w-full gap-3">
                <a title="View Product" href="{{ route('product.show', $product->slug) }}" class="p-[.5rem] rounded-full bg-gray-200/50 border hover:text-yellow-600 transition-all">
                    <svg class="w-[20px] h-[20px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
                        <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1">
                            <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                            <path d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z"/>
                        </g>
                    </svg>
                </a>
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
                @if(Auth::check())
                    <a title="Edit Product" href="{{ route('product.edit', $product->slug) }}" class="p-[.5rem] rounded-full bg-gray-200/50 border hover:text-yellow-600 transition-all">
                        <svg class="w-[20px] h-[20px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7.418 17.861 1 20l2.139-6.418m4.279 4.279 10.7-10.7a3.027 3.027 0 0 0-2.14-5.165c-.802 0-1.571.319-2.139.886l-10.7 10.7m4.279 4.279-4.279-4.279m2.139 2.14 7.844-7.844m-1.426-2.853 4.279 4.279"/>
                        </svg>
                    </a>
                    <form action="{{ route('product.destroy', $product->slug) }}" method="post" class="hidden" id="delete-{{$product->slug}}">@csrf @method('DELETE')</form>
                    <button title="Delete Product" class="p-[.5rem] rounded-full bg-gray-200/50 border hover:text-yellow-600 transition-all" form="delete-{{$product->slug}}">
                        <svg class="w-[20px] h-[20px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                        </svg>
                    </button>
                @endif
            </div>
        </div>
    @empty
        <span class="w-full text-center">Products Belum Ada</span>
    @endforelse
</div>
