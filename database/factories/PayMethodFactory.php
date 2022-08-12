<?php

namespace Database\Factories;

use App\Models\PayMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayMethodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PayMethod::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "pg" => "123",
            "method" => "123",
            "name" => $this->faker->name,
            "commission" => "1",
            "used" => true
        ];
    }
}
