<?php

namespace Database\Factories;

use App\Enums\ChargeState;
use App\Models\Charge;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChargeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Charge::class;

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
            "name" => $user->contact,
            "price" => rand(10000,100000),
            "created_at" => Carbon::now()
        ];
    }
}
