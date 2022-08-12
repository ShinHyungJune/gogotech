<?php

namespace Database\Factories;

use App\Models\DeliveryAmount;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryAmountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DeliveryAmount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product = Product::first();

        if(!$product)
            $product = Product::factory()->create();

        return [
            "product_id" => $product->id,
            "count" => rand(0,10)
        ];
    }
}
