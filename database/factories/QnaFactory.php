<?php

namespace Database\Factories;

use App\Models\Qna;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class QnaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Qna::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::first() ? User::first() : User::factory()->create();

        return [
            "user_id" => $user->id,
            "question" => $this->faker->paragraph,
            "answer" => $this->faker->paragraph,
        ];
    }
}
