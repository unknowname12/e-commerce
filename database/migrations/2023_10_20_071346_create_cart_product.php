<?php

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_product', function (Blueprint $table) {
            $table->foreignIdFor(Cart::class)->constrained('carts')->onDelete('cascade');
            $table->foreignIdFor(Product::class)->constrained('products')->onDelete('cascade');

            $table->primary(['cart_id','product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_product');
    }
};
