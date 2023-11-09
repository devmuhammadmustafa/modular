<?php

namespace Modules\Category\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Category\app\Models\Category::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title_az' => $this->faker->sentence,
            'title_ru' => $this->faker->sentence,
            'title_en' => $this->faker->sentence,
            'image' => $this->faker->image
        ];
    }
}

