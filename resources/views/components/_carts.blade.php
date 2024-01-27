@props(['carts'])
    <div class="overflow-x-auto">
        <table class="border border-b-0 text-gray-500 w-full text-sm">
            <thead class="border-b bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap text-center">No.</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap text-center">Product</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap text-center">Author</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap text-center">Quantity</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap text-center">Status</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap text-center">Price</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap text-center">Create At</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap text-center">Action</th>
                </tr>
            </thead>
            <tbody class="border-b">
                @forelse($carts as $no => $cart)
                    <tr>
                        <th class="px-6 py-[1rem] whitespace-nowrap text-center border-r">{{ $carts->firstItem() + $no . '.' }}</th>
                        <td class="px-6 py-[1rem] whitespace-nowrap text-center">
                            <a href="{{ route('product.show', $cart->product->slug) }}" class="hover:text-yellow-600">{{ $cart->product->title }}</a>
                        </td>
                        <td class="px-6 py-[1rem] whitespace-nowrap text-center">{{ $cart->user->name }}</td>
                        <td class="px-6 py-[1rem] whitespace-nowrap text-center">{{ $cart->qyt . 'x' }}</td>
                        <td class="px-6 py-[1rem] whitespace-nowrap text-center">
                            @if(!$cart->status)
                                <span class="bg-red-100 text-red-800 text-center text-xs font-medium border px-2.5 py-0.5 rounded mr-2">Belum Dibayar</span>
                            @else
                                <span class="bg-green-100 text-green-800 text-xs font-medium border px-2.5 py-0.5 rounded mr-2">Sudah Dibayar</span>
                            @endif
                        </td>
                        <td class="px-6 py-[1rem] whitespace-nowrap text-center">{{ $cart->getTotalPriceQyt() }}</td>
                        <td class="px-6 py-[1rem] whitespace-nowrap text-center">{{ $cart->created_at->isoFormat('D/M/Y') }}</td>
                        <td>
                            <div class="px-6 py-[1rem] whitespace-nowrap text-center inline-flex justify-center items-center gap-3">
                                @if(Route::is('cart.index'))
                                    <button id="{{ $cart->slug . '-dropdown' }}" data-dropdown-toggle="{{ $cart->slug . '-dropdown' }}" title="Edit Cart" class="p-[.5rem] rounded-full bg-gray-200/50 border hover:text-yellow-600 transition-all" type="button">
                                        <svg class="w-[20px] h-[20px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7.418 17.861 1 20l2.139-6.418m4.279 4.279 10.7-10.7a3.027 3.027 0 0 0-2.14-5.165c-.802 0-1.571.319-2.139.886l-10.7 10.7m4.279 4.279-4.279-4.279m2.139 2.14 7.844-7.844m-1.426-2.853 4.279 4.279"/>
                                        </svg>
                                    </button>
                                @endif
                                <form action="{{ route('cart.destroy', $cart->id) }}" method="post" class="hidden" id="{{ 'delete-' . $cart->slug }}">@csrf @method('DELETE')</form>
                                <button type="submit" title="Delete Cart" class="p-[.5rem] rounded-full bg-gray-200/50 border hover:text-yellow-600 transition-all" form="{{ 'delete-' . $cart->slug }}">
                                    <svg class="w-[20px] h-[20px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <div id="{{ $cart->slug . '-dropdown' }}" class="z-10 hidden w-auto p-3 bg-white rounded-lg shadow border">
                        <form action="{{ route('cart.update', $cart->slug) }}" method="post" id="{{ $cart->slug . '-updated' }}">
                            @csrf
                            @method('PATCH')
                            <div class="flex flex-col justify-start items-center w-full gap-2">
                                <div class="flex items-start flex-col justify-start w-full" aria-labelledby="{{ $cart->slug . '-dropdown' }}">
                                    <label for="qyt" class="hidden">Quantity:</label>
                                    <select id="qyt" name="qyt" class="w-full text-gray-500 bg-white border border-gray-300 rounded-lg text-sm">
                                        <option selected disabled>Choose a quantity</option>
                                        <option value="1" {{ $cart->qyt == 1 ? 'selected' : '' }}>1x</option>
                                        <option value="2" {{ $cart->qyt == 2 ? 'selected' : '' }}>2x</option>
                                        <option value="3" {{ $cart->qyt == 3 ? 'selected' : '' }}>3x</option>
                                        <option value="4" {{ $cart->qyt == 4 ? 'selected' : '' }}>4x</option>
                                        <option value="5" {{ $cart->qyt == 5 ? 'selected' : '' }}>5x</option>
                                    </select>
                                    <x-error :messages="$errors->get('qyt')"/>
                                </div>
                                <div class="flex flex-col justify-center items-center w-full">
                                    <button type="submit" class="text-white bg-gray-700 hover:bg-gray-800 w-full rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-200" form="{{ $cart->slug . '-updated' }}">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-[1rem] whitespace-nowrap text-center">Carts Tidak Ada</td>
                    </tr>
               @endforelse
            </tbody>
            <tfoot class="border-b">
                <th colspan="3" class="px-6 py-2 whitespace-nowrap text-start">Pembayaran - {{ $carts->count() != null ? $carts->count() . 'x' : 'Belum Ada Pesanan!' }}</th>
                <th colspan="2" class="px-6 py-2 whitespace-nowrap text-end">Total pembayaran:</th>
                <th class="px-6 py-2 whitespace-nowrap text-center border-x">
                    @if(Route::is('cart.index'))
                        {{ \App\Http\Controllers\actions\CartController::getPriceAll(\App\Models\Cart::class) }}
                    @elseif(Route::is('cart.index.payment'))
                        {{ \App\Http\Controllers\actions\CartController::getPriceAllPayment(\App\Models\Cart::class) }}
                    @endif
                </th>
                <td colspan="2">
                    <div class="px-6 py-2 whitespace-nowrap text-center inline-flex justify-center items-center gap-3 w-full">
                        @if(Route::is('cart.index'))
                            @if($carts->count() != 0)
                                <button data-modal-target="{{ $cart->slug . '-modal' }}" data-modal-toggle="{{ $cart->slug . '-modal' }}" title="Lanjutkan Pembayaran" class="p-[.5rem] rounded-lg bg-gray-200/50 border hover:text-yellow-600 transition-all" type="button">
                                    <svg class="w-[20px] h-[20px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 19 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm1-4H5m0 0L3 4m0 0h5.501M3 4l-.792-3H1m11 3h6m-3 3V1"/>
                                    </svg>
                                </button>
                            @endif
                            <a href="{{ route('cart.index.payment', Auth::user()->slug) }}" title="Lihat Pembayaran Berhasil" class="p-[.5rem] rounded-lg bg-gray-200/50 border hover:text-yellow-600 transition-all">
                                <svg class="w-[20px] h-[20px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="18" height="20" fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="1" d="M12 2h4a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h4m6 0v3H6V2m6 0a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1M5 5h8m-5 5h5m-8 0h.01M5 14h.01M8 14h5"/>
                                </svg>
                            </a>
                        @elseif(Route::is('cart.index.payment'))
                            <a href="{{ route('cart.index', Auth::user()->slug) }}" title="Kembali" class="p-[.5rem] rounded-lg bg-gray-200/50 border hover:text-yellow-600 transition-all">
                                Kembali
                            </a>
                        @endif
                    </div>
                </td>
                @if(\Illuminate\Support\Facades\Route::is('cart.index') && $carts->count() != 0)
                    <div id="{{ $cart->slug . '-modal' }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-md max-h-full">
                            <form action="{{ route('cart.payment', $cart->slug) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">Pembayaran Lanjutan</h3>
                                    </div>
                                    <div class="p-6 space-y-6">
                                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                            With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                                        </p>
                                    </div>
                                    <div class="flex items-start px-6 pb-6 flex-col justify-start w-full">
                                        <label for="payment">Payments Metode:</label>
                                        <select id="payment" name="payment" class="w-full text-gray-500 bg-white border border-gray-300 rounded-lg">
                                            <option selected disabled>Choose a payment metode</option>
                                            <option value="Payment Cod">Payment Cod</option>
                                            <option value="Payment Now">Payment Now</option>
                                        </select>
                                        <x-error :messages="$errors->get('payment')"/>
                                    </div>
                                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        <button data-modal-hide="{{ $cart->slug . '-modal' }}" type="submit" class="text-white bg-gray-700 hover:bg-gray-800 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-200" title="Lanjutkan">Lanjutkan</button>
                                        <button data-modal-hide="{{ $cart->slug . '-modal' }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900" title="Kembali">Kembali</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </tfoot>
        </table>
        {{--<table class="w-full text-sm text-left text-gray-500 border">
            <tfoot class="border-t">
                <td colspan="3">
                    <div class="inline-flex justify-center items-center w-full gap-3">
                        @if(Route::is('cart.index'))
                            @if($carts->count() != null)
                                @foreach($cart->products as $product)
                                    <button data-modal-target="staticModal" data-modal-toggle="staticModal" class="hover:text-yellow-600 whitespace-nowrap border rounded-full p-1 px-3 hover:bg-gray-300/30" type="button">
                                        Bayar Sekarang
                                    </button>
                                    <div id="staticModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative w-full max-w-2xl max-h-full">
                                            <div class="relative bg-white rounded-lg shadow">
                                                <div class="flex items-start justify-between p-4 border-b rounded-t">
                                                    <div class="inline-flex justify-between items-center w-full">
                                                        <h3 class="text-xl font-semibold text-gray-900">
                                                            Pembayaran
                                                        </h3>
                                                        <span class="text-sm">{{ 'Total' . ' - ' . $cart->getPriceByFormat($cart->getPriceAll()) }}</span>
                                                    </div>
                                                </div>
                                                <div class="p-6 space-y-6">
                                                    <p class="text-base leading-relaxed text-gray-500">
                                                        With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                                                    </p>
                                                </div>
                                                <form action="{{ route('cart.payment') }}" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="flex items-start px-6 pb-6 flex-col justify-start">
                                                        <label for="payment">Payment</label>
                                                        <select id="payment" name="payment" class="w-full border-gray-300 bg-gray-200/60 rounded-lg">
                                                            <option selected disabled>Choose a payment</option>
                                                            <option value="Payment Cod">Payment Cod</option>
                                                            <option value="Payment Now">Payment Now</option>
                                                        </select>
                                                    </div>
                                                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                                        <button data-modal-hide="staticModal" type="submit" class="px-5 py-2.5 text-white bg-gray-700 hover:bg-gray-800 font-medium rounded-lg text-sm">Bayar</button>
                                                        <button data-modal-hide="staticModal" type="button" class="px-5 py-2.5 text-gray-500 bg-white hover:bg-gray-100 font-medium rounded-lg text-sm">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <a href="{{ route('cart.index.payment', Auth::user()->slug) }}" class="hover:text-yellow-600 whitespace-nowrap">Lihat Pembayaran Selesai</a>
                        @elseif(Route::is('cart.index.payment'))
                            <a href="{{ route('cart.index', Auth::user()->slug) }}" class="hover:text-yellow-600 whitespace-nowrap">Kembali</a>
                        @endif
                    </div>
                </td>
            </tfoot>
        </table>--}}
    </div>
