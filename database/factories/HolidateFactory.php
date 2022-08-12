<?php

namespace Database\Factories;

use App\Models\Holidate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class HolidateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Holidate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "closed_at" => Carbon::now(),
        ];
    }
}
