<?php

namespace Database\Factories;

use App\Models\Nutrition;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class NutritionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Nutrition::class;

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
            "salt" => $this->faker->title,
            "carbohydrate" => $this->faker->title,
            "sugar" => $this->faker->title,
            "trans_fat" => $this->faker->title,
            "saturated_fat" => $this->faker->title,
            "cholesterol" => $this->faker->title,
            "protein" => $this->faker->title,
            "calorie" => $this->faker->title,
        ];
    }
}
