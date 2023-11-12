<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => rand(1, 2),
            'merchant_id' => fake()->randomElement([6, 816]),
            'payment_id' => rand(1, 100),
            'status' => rand(1, 5),
            'amount' => rand(100, 500),
            'amount_paid' => rand(100, 500),
            'rand' => fake()->text,
            'timestamp' => fake()->unixTime,
        ];
    }
}
