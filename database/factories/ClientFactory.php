<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
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
            'email' => $this->faker->unique()->safeEmail,
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", // password
            'phone' => $this->faker->numberBetween(1123456,9876254),
            'notes' => $this->faker->text,
        ];
    }
}
