<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicles>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['Orang', 'Barang']),
            'model' => $this->faker->randomElement(['Honda', 'Yamaha', 'Suzuki', 'Toyota', 'Mitsubishi', 'Daihatsu']),
            'license_plate' => $this->faker->unique()->regexify('[A-Z]{1,3} [0-9]{1,4} [A-Z]{1,3}'),
            'fuel_consumption' => $this->faker->numberBetween(1, 100),
            'maintenance_schedule' => $this->faker->date(),
            'status' => $this->faker->randomElement(['Tersedia', 'Digunakan']),
        ];
    }
}
