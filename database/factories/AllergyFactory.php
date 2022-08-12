<?php

namespace Database\Factories;

use App\Models\Allergy;
use Illuminate\Database\Eloquent\Factories\Factory;

class AllergyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Allergy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->unique()->name
        ];
    }
}
