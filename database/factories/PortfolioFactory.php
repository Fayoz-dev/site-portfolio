<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\PortfolioCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortfolioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'title' => $this->faker->title,
            'category_id' => PortfolioCategory::all()->random()->id,
            'image' => $this->faker->url,
            'video' => $this->faker->url,
            'published_date' => $this->faker->date('2022-10-5'),
            'client_id' => Client::all()->random()->id,
            'description' => $this->faker->text,




        ];
    }
}
