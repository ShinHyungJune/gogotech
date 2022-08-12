<?php

namespace Database\Factories;

use App\Models\Basic;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class BasicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Basic::class;

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
            "amount" => $this->faker->title,
            "type" => $this->faker->title,
            "step" => $this->faker->title,
            "weight" => $this->faker->title,
            "storage_method" => $this->faker->title,
            "age" => $this->faker->title,
            "shelf_life" => $this->faker->title,
        ];
    }
}
