<?php

namespace Modules\Product\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Category\app\Models\Category;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Product\app\Models\Product::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'category_id'=> Category::query()->inRandomOrder()->first()->id,
            'title_az' => $this->faker->sentence,
            'title_ru' => $this->faker->sentence,
            'title_en' => $this->faker->sentence,
            'description_az' => $this->faker->paragraph,
            'description_ru' => $this->faker->paragraph,
            'description_en' => $this->faker->paragraph,
            'image' => $this->faker->image
        ];
    }
}

