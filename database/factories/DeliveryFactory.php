<?php

namespace Database\Factories;

use App\Models\Delivery;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Delivery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "default" => false,
            "title" => $this->faker->title,
            "name" => $this->faker->title,
            "contact" => $this->faker->title,
            "address" => $this->faker->title,
            "address_detail" => $this->faker->title,
            "address_zipcode" => $this->faker->title,
            "memo" => $this->faker->title
        ];
    }
}
