<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\PaymentMethod;
use App\Models\SaleType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sale_type_id' => SaleType::factory(),
            'client_id' => Client::factory(),
            'sub_total' => $this->faker->randomFloat(2, 100, 500),
            'igv' => $this->faker->randomFloat(2, 10, 50),
            'total' => $this->faker->randomFloat(2, 200, 550),
            'payment_method_id' => PaymentMethod::factory(),
            'fecha_venta' => $this->faker->dateTimeThisYear(),
        ];
    }
}
