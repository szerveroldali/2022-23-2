<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            // 'style' => fake()->randomElement([
            //     'primary',
            //     'secondary',
            //     'success',
            //     'danger',
            //     'warning',
            //     'info',
            //     'light',
            //     'dark',
            // ]),
            'style' => Arr::random([
                'primary',
                'secondary',
                'success',
                'danger',
                'warning',
                'info',
                'light',
                'dark',
            ]),
        ];
    }
}
