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
            //'category_id' => ,
            'code' => $this->faker->word,
            'size' => $this->faker->numberBetween(5, 10),
        ];
    }
}
