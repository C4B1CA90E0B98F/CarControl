<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UsageHistory>
 */
class UsageHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => function () {
                return Order::all()->random()->id;
            },
            'distance' => $this->faker->randomElement(['100', '200', '300', '400', '500']),
            'fuel_consumption' => $this->faker->randomElement(['100', '200', '300', '400', '500']),
        ];
    }
}
