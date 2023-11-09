<?php

namespace Modules\Product\database\seeders;

use Illuminate\Database\Seeder;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $this->call([ProductSeeder::class,GallerySeeder::class]);
    }
}
