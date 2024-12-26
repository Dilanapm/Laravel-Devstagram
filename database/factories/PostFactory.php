<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // laravel tiene integrado una libreria llamada faker para hacer testing a tu base de datos
        return [
            'titulo' => $this->faker->sentence(5), // sentence creara un enunciado con 5 que se refiere a cuantas palabras son las que se van a urtilizar
            'descripcion' => $this->faker->sentence(20),
            'imagen' => $this->faker->uuid(). '.jpg',
            'user_id' => $this->faker->randomElement([4,5,6,7,8]) // randomElement lo que hara es seleccionar de manera aleatoria datos que estan guardados en un arreglo
        ];
    }
}
