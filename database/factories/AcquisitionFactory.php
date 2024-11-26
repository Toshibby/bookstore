<?php

namespace Database\Factories;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Acquisition>
 */
class AcquisitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'supplier_id' => Supplier::factory(),
            'fecha_adquisicion' => $this->faker->date(),
            'monto_total' => $this->faker->randomFloat(2, 100, 1000),
            'estado' => $this->faker->randomElement(['pendiente', 'completada', 'cancelada']),
            'detalle' => $this->faker->sentence(),
            'user_id' => User::factory(),
        ];
    }
}
