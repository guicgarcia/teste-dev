<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'author' => $this->faker->word,
            'code' => $this->faker->word,
            'type' => 'Arquivo digital',
            'size' => $this->faker->numberBetween(5, 10),
        ];
    }
}
