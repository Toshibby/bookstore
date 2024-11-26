<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word(),
            'imagen' => $this->faker->imageUrl(),
            'cantidad_stock' => $this->faker->numberBetween(10, 100),
            'descripcion' => $this->faker->sentence(),
            'category_id' => Category::factory(),
            'costo_compra' => $this->faker->randomFloat(2, 5, 50),
            'precio_venta' => $this->faker->randomFloat(2, 50, 100),
        ];
    }
}
