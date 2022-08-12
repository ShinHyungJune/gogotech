<?php

namespace Database\Factories;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "diet_id" => null,
            "round" => null,
            "delivery_at" => Carbon::now()->addDays(2),
            "ended_at" => Carbon::now()->addDays(4),

            "title" => $this->faker->unique()->name,
            "description" => $this->faker->paragraph,
            "price" => rand(1, 100),
            "isDiet" => false,
            "count_order" => rand(0, 10000)
        ];
    }
}
