<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = collect();
        for ($i = 0; $i < 20; $i++){
            $users -> add(User::factory()->create([
                'email' => 'user' . $i . '@szerveroldali.hu'
            ]));
        }

        $posts = collect();
        for ($i = 0; $i < 20; $i++){
            $p = Post::factory()->create([
                'author_id' => $users -> random() -> id
            ]);
            $posts -> add($p -> id);
        }

        for ($i = 0; $i < 20; $i++){
            $c = Category::factory()->create();
            $c -> posts() -> sync( $posts -> random(rand(1, $posts -> count())));
        }
    }
}
