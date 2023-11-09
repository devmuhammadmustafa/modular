<?php

namespace Modules\Blog\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Blog\app\Models\Blog::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
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

