<?php

namespace App\Http\Controllers\actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function index(string $slug)
    {
        $user = User::query()->where('slug', $slug)->firstOrFail();
        $carts = Cart::query()->where('user_id', $user->id)->whereStatus(false)->latest()->paginate(10);
        $total_price = $carts->sum('price');
        return view('cards.index', compact(['carts', 'total_price']));
    }

    public static function getFormat($amount): string
    {
        return 'IDR. ' . number_format(($amount), 0, ',', '.');
    }

    public static function getPriceAll($cart): string
    {
        $total = 0;
        $carts = Cart::query()->whereStatus(false)->get();
        foreach ($carts as $cc) {
            $price = $cc->price * $cc->qyt;
            $total += $price;
        }
        return self::getFormat($total);
    }

    public static function getPriceAllPayment($cart): string
    {
        $total = 0;
        $user = User::query()->where('slug', Auth::user()->slug)->firstOrFail();
        $carts = Cart::query()->where('user_id', $user->id)->whereStatus(true)->get();
        foreach ($carts as $cc) {
            $price = $cc->price * $cc->qyt;
            $total += $price;
        }
        return self::getFormat($total);
    }

    public function paymentIndex(string $slug)
    {
        $user = User::query()->where('slug', $slug)->firstOrFail();
        $carts = Cart::query()->where('user_id', $user->id)->whereStatus(true)->latest()->paginate(10);
        $total_price = $carts->sum('price');
        return view('cards.payment', compact(['carts', 'total_price']));
    }

    public function store(CartRequest $request)
    {
        $cart = new Cart();
        $cart->name = $request->input('name');
        $cart->user_id = $request->user()->id;
        $cart->product_id = $request->input('product_id');
        $cart->status = 0;
        $cart->price = $request->input('price');
        $cart->qyt = $request->input('qyt');
        $cart->save();

        $cart_id = $cart->id;
        $product_id = $cart->product_id;

        while (DB::table('cart_product')->where('cart_id', $cart_id)->where('product_id', $product_id)->exists()){
            noty()->addSuccess('Product sudah ada didalam cart!');
        }

        DB::table('cart_product')->insert([
            'cart_id' => $cart_id,
            'product_id' => $product_id
        ]);

        noty()->addSuccess('Kamu berhasil membuat cart baru!');
        return Redirect::back();
    }

    public function update(string $slug, Request $request)
    {
        $cart = Cart::query()->where('slug', $slug)->firstOrFail();

        $request->validate([
            'qyt' => ['required', 'numeric', 'min:1', 'max:5']
        ]);

        $cart->update(
            $request->all()
        );

        noty()->addSuccess('Kamu berhasil memperbaruhi cart!');
        return Redirect::back();
    }

    public function destroy(string $slug)
    {
        $cart = Cart::query()->where('id', $slug)->firstOrFail();
        $cart->delete();
        noty()->addSuccess('Kamu berhasil menghapus cart!');
        return Redirect::back();
    }

    public function payment(Request $request)
    {
        $request->validate([
            'payment' => ['required']
        ]);

        $carts = Cart::query()->where('status', false)->get();
        foreach ($carts as $cart){
            $cart->status = true;
            $cart->save();
            noty()->addSuccess("Kamu berhasil membayar " . $cart->name . "!");
        }
        noty()->addSuccess("Metode Pembayaran: " . $request->input('payment'));
        return Redirect::back();
    }
}
