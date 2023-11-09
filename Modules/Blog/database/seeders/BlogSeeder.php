<?php

namespace Modules\Blog\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Blog\app\Models\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Blog::factory()->count(10)->create();
    }
}
