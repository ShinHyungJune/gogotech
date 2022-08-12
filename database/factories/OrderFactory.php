<?php

namespace Database\Factories;

use App\Enums\OrderState;
use App\Models\Order;
use App\Models\PayMethod;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::first() ? User::first() : User::factory()->create();
        $payMethod = PayMethod::first() ? PayMethod::first() : PayMethod::factory()->create();

        return [
            "imp_uid" => uniqid(),
            "merchant_uid" => uniqid(),

            "user_id" => $user->id,
            "user_name" => $this->faker->title,
            "user_contact" => $this->faker->title,
            "user_email" => $this->faker->title,

            "pay_method_id" => $payMethod->id,
            "pay_method_name" => $this->faker->title,
            "pay_method_pg" => $this->faker->title,
            "pay_method_method" => $this->faker->title,
            "pay_method_commission" => $this->faker->title,

            "delivery_name" => $this->faker->title,
            "delivery_contact" => $this->faker->title,
            "delivery_address" => $this->faker->title,
            "delivery_address_detail" => $this->faker->title,
            "delivery_memo" => $this->faker->title,
            "delivery_price" => 0,

            "coupon_id" => null,
            "coupon_title" => null,
            "coupon_price_min" => null,
            "coupon_price_discount" => null,

            "point_use" => 0,
            "point_give" => 0,

            "price_total" => random_int(1000,10000),
            "price_real" => random_int(1000,10000),

            "vbank_num" => null,
            "vbank_date" => null,
            "vbank_name" => null,

            "state" => OrderState::SUCCESS,
            "memo" => null,
            "delivery_at" => Carbon::now()->addDays(2)
        ];
    }
}
