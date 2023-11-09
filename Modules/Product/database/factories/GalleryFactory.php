<?php

namespace Modules\Product\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Product\app\Models\Product;

class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Product\app\Models\Gallery::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            "product_id" => Product::query()->inRandomOrder()->first()->id,
            'image'=> $this->faker->image
        ];
    }
}

