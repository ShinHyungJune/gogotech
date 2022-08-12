<?php

namespace Database\Factories;

use App\Models\Holiday;
use Illuminate\Database\Eloquent\Factories\Factory;

class HolidayFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Holiday::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "mon" => false,
            "tue" => false,
            "wed" => false,
            "thur" => false,
            "fri" => false,
            "sat" => false,
            "sun" => false,
        ];
    }
}
