<?php

namespace Database\Factories;

use App\Models\DeliveryAmount;
use App\Models\DeliveryDate;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryDateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DeliveryDate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $deliveryAmount = DeliveryAmount::first();

        if(!$deliveryAmount)
            $deliveryAmount = DeliveryAmount::factory()->create();

        return [
            "delivery_amount_id" => $deliveryAmount->id,
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
