<?php

namespace Database\Seeders;

use App\Models\LeadCategory;
use Illuminate\Database\Seeder;

class LeadCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeadCategory::factory()->count(10)->create();
    }
}
