<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([

            UserSeeder::class,
            ClientSeeder::class,
            PortfolioCategorySeeder::class,
            PortfolioSeeder::class,
            TeamMemberSeeder::class,
            ImageFileSeeder::class,
            PortfolioJoinImageFileSeeder::class,
            LeadCategorySeeder::class,
            LeadSeeder::class,
            FeedbackSeeder::class,
            FaqSeeder::class,
        ]);
    }
}
