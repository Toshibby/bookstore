<?php

namespace Database\Factories;

use App\Models\Acquisition;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseOrder>
 */
class PurchaseOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'acquisition_id' => Acquisition::factory(),
            'product_id' => Product::factory(),
            'cantidad' => $this->faker->numberBetween(1, 100),
            'precio_unitario' => $this->faker->randomFloat(2, 5, 50),
            'total' => $this->faker->randomFloat(2, 100, 5000),
            'estado' => $this->faker->randomElement(['pendiente', 'completada', 'cancelada']),
            'fecha_orden' => $this->faker->date(),
        ];
    }
}
