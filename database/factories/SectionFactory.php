<?php

namespace Database\Factories;

use App\Models\Section;
use App\Models\Survey;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Section::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $survey = Survey::first() ? Survey::first() : Survey::factory()->create();

        return [
            "survey_id" => $survey->id,
            "order" => $survey->sections()->count(),
            "title" => $this->faker->title,
            "description" => $this->faker->title
        ];
    }
}
