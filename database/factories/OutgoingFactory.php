<?php

namespace Database\Factories;

use App\Enums\OutgoingState;
use App\Models\Order;
use App\Models\Outgoing;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class OutgoingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Outgoing::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $order = Order::factory()->create();

        return [
            "order_id" => $order->id,
            "state" => OutgoingState::WAIT,
            "delivery_at" => Carbon::now(),
            "delivery_number" => ""
        ];
    }
}
