<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'name' => $this->faker->lastName,
            'surname' => $this->faker->firstName,
            'position' => $this->faker->name,
            'comment' => "comment",
            'rating_double' => $this->faker->numberBetween(1,20),

        ];
    }
}
