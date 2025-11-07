<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idProveedor' => 1,  // Valor fijo, puedes modificarlo si lo deseas
            'codigoProducto' => 123456789123,       // Valor fijo, puedes cambiarlo a un valor generado dinámicamente si es necesario
            'nombreProducto' => $this->faker->word(), // Generar un nombre de producto aleatorio
            'descripcionProducto' => $this->faker->sentence(), // Generar una descripción aleatoria
            'cantidadProducto' => $this->faker->randomNumber(2), // Generar una cantidad aleatoria
            'costoProducto' => $this->faker->randomFloat(2, 10, 100), // Generar un costo entre 10 y 100
            'gananciaProducto' => $this->faker->randomFloat(2, 1, 10), // Generar una ganancia entre 1 y 10
            'precioProducto' => $this->faker->randomFloat(2, 15, 30), // Generar un precio entre 15 y 30
            'imageProducto' => $this->faker->imageUrl(), // Generar una URL de imagen aleatoria
        ];        
    }
}
