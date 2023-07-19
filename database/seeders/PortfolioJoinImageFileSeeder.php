<?php

namespace Database\Seeders;

use App\Models\PortfolioJoinImageFile;
use Illuminate\Database\Seeder;

class PortfolioJoinImageFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PortfolioJoinImageFile::factory()->count(10)->create();
    }
}
