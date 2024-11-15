<?php

namespace Database\Factories;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->words(3, true),
            'descripcion' => $this->faker->sentence(),
            'precio' => $this->faker->randomFloat(2, 10, 1000),
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),
            'imagen' => 'productos/' . $this->faker->image('public/storage/productos', 400, 300, null, false),
            'id_categoria' => Categoria::factory(),
            'id_proveedor' => Proveedor::factory(),
        ];
    }
}