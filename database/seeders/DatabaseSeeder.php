<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Page;
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
         Category::factory(4)
             ->has(Page::factory()->count(7))
             ->create();

//         Page::factory(50)->create();
    }
}
