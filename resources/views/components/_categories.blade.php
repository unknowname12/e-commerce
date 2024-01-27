@props(['categories', 'category', 'active'])

@switch($active)
    @case('link')
        <div class="flex flex-row justify-start items-center">
            @forelse($categories as $categorys)
                <a href="{{ route('category.show', $categorys->slug) }}" class="{{ $categorys->title == $category->title ? 'bg-yellow-800 text-yellow-100' : 'bg-yellow-100 text-yellow-800'}} shadow text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300 whitespace-nowrap">#{{ $categorys->title }}</a>
            @empty
                <span class="text-center text-xs font-medium border px-2.5 py-0.5 rounded mr-2">Categories Belum Ada</span>
            @endforelse
                <a href="{{ route('product.index') }}" class="{{ Route::is(['product.search','product.index']) ? 'bg-yellow-800 text-yellow-100' : 'bg-yellow-100 text-yellow-800'}} shadow text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">#All</a>
        </div>
    @break
    @default
        <div class="flex flex-row justify-start items-center">
            @forelse($categories as $categorys)
                <a href="{{ route('category.show', $categorys->slug) }}" class="bg-yellow-100 text-yellow-800 shadow text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300 whitespace-nowrap">#{{ $categorys->title }}</a>
            @empty
                <span class="text-center text-xs font-medium border px-2.5 py-0.5 rounded mr-2">Categories Belum Ada</span>
            @endforelse
                <a href="{{ route('product.index') }}" class="{{ Route::is(['product.search','product.index']) ? 'bg-yellow-800 text-yellow-100' : 'bg-yellow-100 text-yellow-800'}} shadow text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">#All</a>
        </div>
@endswitch

