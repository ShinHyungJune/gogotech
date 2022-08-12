<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CartProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product = Product::first() ? Product::first() : Product::factory()->create();

        $cart = Cart::first() ? Cart::first() : Cart::factory()->create();

        return [
            "product_id" => $product->id,
            "cart_id" => $cart->id,
            "count" => 1,
            "delivery_at" => Carbon::now()->addDays(2),
            "can_order" => true
        ];
    }
}
