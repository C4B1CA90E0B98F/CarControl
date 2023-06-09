<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Approval>
 */
class ApprovalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'approver_id' => function () {
                return User::where('role', 'approver')->get()->random()->id;
            },
            'status' => $this->faker->randomElement(['Menunggu', 'Disetujui', 'Ditolak']),
        ];
    }
}
