<x-layouts.main title="Index">
    <hr class="my-[1rem]">
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">Category Name</th>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">Author</th>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">Create At</th>
                <th scope="col" class="px-6 py-3 whitespace-nowrap">Update At</th>
                <th scope="col" class="px-6 py-3 whitespace-nowrap text-center">Action</th>
            </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a href="{{ route('category.show', $category->slug) }}" class="hover:text-yellow-600">{{ $category->title }}</a>
                        </th>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $category->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $category->created_at->isoFormat('D/M/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $category->updated_at->diffForHumans() }}</td>
                        @if(Auth::check())
                            <td class="">
                                <div class="flex justify-center items-center gap-2">
                                    <a title="Edit Category" href="{{ route('category.edit', $category->slug) }}" class="p-[.5rem] rounded-full bg-gray-200/50 border hover:text-yellow-600 transition-all">
                                        <svg class="w-[20px] h-[20px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7.418 17.861 1 20l2.139-6.418m4.279 4.279 10.7-10.7a3.027 3.027 0 0 0-2.14-5.165c-.802 0-1.571.319-2.139.886l-10.7 10.7m4.279 4.279-4.279-4.279m2.139 2.14 7.844-7.844m-1.426-2.853 4.279 4.279"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('category.destroy', $category->slug) }}" method="post" class="hidden" id="delete-{{$category->slug}}">@csrf @method('DELETE')</form>
                                    <button title="Delete Category" class="p-[.5rem] rounded-full bg-gray-200/50 border hover:text-yellow-600 transition-all" form="delete-{{$category->slug}}">
                                        <svg class="w-[20px] h-[20px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        @else
                            <td class="px-6 py-4 whitespace-nowrap">
                                No Access
                            </td>
                        @endif
                    </tr>
                @empty
                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center">Categories Belum Ada</td>
                @endforelse
            </tbody>
        </table>
    </div>
    <hr class="my-[1rem]">
    {{ $categories->onEachSide(1)->links() }}
</x-layouts.main>
