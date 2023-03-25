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
        $userCount = rand(10, 20);
        for ($i = 1; $i <= $userCount; $i++){
            $u = User::factory()->create([
                'email' => 'user' . $i .  '@szerveroldali.hu'
            ]);
            $users -> add($u);
        }

        $posts = collect();
        $postCount = rand(30, 50);
        for ($i = 1; $i <= $postCount; $i++){
            $p = Post::factory()->create([
                'author_id' => $users -> random() -> id
            ]);
            $posts -> add($p);
        }

        $categoryCount = rand(5, 10);
        for ($i = 1; $i <= $categoryCount; $i++){
            $c = Category::factory() -> create();
            $c -> posts() -> sync( $posts -> random(rand(2, 10)) -> pluck('id') );
        }
    }
}
