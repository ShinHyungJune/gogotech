<?php

namespace Database\Factories;

use App\Models\DeliveryDuration;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryDurationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DeliveryDuration::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "week" => rand(0,10),
            "discount_ratio" => rand(0,20),
        ];
    }
}
