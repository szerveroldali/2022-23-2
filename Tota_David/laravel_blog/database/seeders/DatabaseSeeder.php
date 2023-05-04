<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $users = User::factory(rand(5, 10))->create();
        $users = collect();
        $user_count = rand(5, 10);

        for ($i = 1; $i <= $user_count; $i++) {
            $users->add(
                User::factory()->create([
                    // uX@szo.hu
                    'email' => 'u' . $i . '@szo.hu',
                ])
            );
        }

        $category_count = rand(8, 15);
        $categories = Category::factory($category_count)->create();
        // Legyen 6-7x annyi Post, mint Category
        $posts = Post::factory($category_count * rand(2,3))->create();

        $posts->each(function ($post) use (&$users, &$categories, &$category_count) {
            // Random user hozzárendelése a post-hoz, mint szerző
            $post->author()->associate(
                $users->random()->id
            );

            $post->save();

            // Random számú kategória hozzárendelése a post-hoz
            // (akár 0 kategória is lehet)
            $post->categories()->sync(
                $categories->random(
                    rand(0, $category_count)
                )
            );
        });

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
