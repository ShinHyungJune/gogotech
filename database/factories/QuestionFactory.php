<?php

namespace Database\Factories;

use App\Enums\QuestionType;
use App\Models\Question;
use App\Models\Section;
use App\Models\Survey;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $section = Section::factory()->create();

        return [
            "section_id" => $section->id,
            "title" => $this->faker->title,
            "title_min" => $this->faker->title,
            "title_max" => $this->faker->title,
            "range" => rand(1,10),
            "description" => $this->faker->paragraph,
            "type" => QuestionType::RADIO,
            "required" => 1,
        ];
    }
}
