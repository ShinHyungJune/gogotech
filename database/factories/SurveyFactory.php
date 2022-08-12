<?php

namespace Database\Factories;

use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SurveyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Survey::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "survey_id" => null,
            "point" => rand(0,10000),
            "title" => $this->faker->title,
            "description" => $this->faker->paragraph,
            "max" => rand(1,1000),
            "finished_at" => Carbon::now()->addDays(30),
            "hide" => 1,
        ];
    }
}
