<?php

namespace Database\Factories;

use App\Models\LeadCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeadFactory extends Factory
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
            'phone' => $this->faker->numberBetween(1123456,9876254),
            'lead_category_id' => LeadCategory::all()->random()->id,

        ];
    }
}
