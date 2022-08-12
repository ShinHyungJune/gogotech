<?php

namespace Database\Factories;

use App\Models\Diet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class DietFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Diet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::first();

        if(!$user)
            $user = User::factory()->create();

        return [
            "user_id" => $user->id,
            "title" => $this->faker->title,
            "delivery_duration" => random_int(1, 8),
            "delivery_started_at" => Carbon::now()->addDays(3),
            "price" => random_int(1,100)
        ];
    }
}
