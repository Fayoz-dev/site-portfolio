<?php

namespace Database\Factories;

use App\Models\ImageFile;
use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortfolioJoinImageFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image_file_id' => ImageFile::all()->random()->id,
            'portfolio_id' => Portfolio::all()->random()->id,
        ];
    }
}
