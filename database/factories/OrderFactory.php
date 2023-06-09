<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\Location;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function () {
                return User::all()->random()->id;
            },
            'vehicle_id' => function () {
                return Vehicle::all()->random()->id;
            },
            'driver_id' => function () {
                return Driver::all()->random()->id;
            },
            'approver_id' => function () {
                return User::where('role', 'approver')->get()->random()->id;
            },
            'approver2_id' => function () {
                return User::where('role', 'approver')->get()->random()->id;
            },
            'from_id' => function () {
                return Location::all()->random()->id;
            },
            'destination_id' => function () {
                return Location::all()->random()->id;
            },
            'date' => $this->faker->date()
        ];
    }
}
