<?php

namespace Database\Factories;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->title,
            "description" => $this->faker->paragraph,
            "count_view" => rand(1,1000),
            "started_at" => Carbon::now(),
            "finished_at" => Carbon::now()->addDays(2),
        ];
    }
}
