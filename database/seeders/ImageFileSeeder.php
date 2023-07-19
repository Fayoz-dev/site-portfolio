<?php

namespace Database\Seeders;

use App\Models\ImageFile;
use Illuminate\Database\Seeder;

class ImageFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImageFile::factory()->count(10)->create();
    }
}
