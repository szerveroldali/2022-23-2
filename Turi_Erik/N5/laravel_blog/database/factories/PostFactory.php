<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => Str::ucfirst(fake() -> words(rand(2, 5), true)),
            'content' => fake() -> paragraph(rand(8, 32)),
            'date' => fake() -> dateTime(),
            'published' => fake() -> boolean(50)
        ];
    }
}
