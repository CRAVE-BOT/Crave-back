<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'status' => $this->faker->randomElement(['Pending', 'Completed', 'Canceled']),
            'total_price' => 0,
            'payment_method' => $this->faker->randomElement(['Cash', 'Credit Card', 'Vodafone Cash','Insta Pay']),
            'order_date' => $this->faker->dateTimeThisYear()
        ];
    }

}
