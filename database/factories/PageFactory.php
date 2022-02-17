<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'text' => $this->faker->realText,
            'datetime_post' => $this->faker->dateTimeBetween('-3 months', '+10 days'),
            'is_posted' => $this->faker->boolean(80),
        ];
    }
}
