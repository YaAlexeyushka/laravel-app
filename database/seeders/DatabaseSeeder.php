<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Tag;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(5)->create();

        $categories = collect([
            ['name' => 'Technology', 'slug' => 'technology', 'description' => 'Tech news and articles'],
            ['name' => 'Programming', 'slug' => 'programming', 'description' => 'Programming tutorials'],
            ['name' => 'Design', 'slug' => 'design', 'description' => 'Design inspiration'],
        ])->map(fn($cat) => Category::create($cat));

        $tags = collect([
            ['name' => 'Laravel', 'slug' => 'laravel'],
            ['name' => 'PHP', 'slug' => 'php'],
            ['name' => 'JavaScript', 'slug' => 'javascript'],
            ['name' => 'CSS', 'slug' => 'css'],
            ['name' => 'Tutorial', 'slug' => 'tutorial'],
        ])->map(fn($tag) => Tag::create($tag));

        foreach ($users as $user) {
            for ($i = 0; $i < 3; $i++) {
                $post = Post::create([
                    'user_id' => $user->id,
                    'title' => "Post {$i} by {$user->name}",
                    'slug' => "post-{$i}-by-" . str_replace(' ', '-', strtolower($user->name)),
                    'content' => 'This is the content of post ' . $i,
                    'is_published' => rand(0, 1),
                    'published_at' => now(),
                    'views' => rand(0, 1000),
                ]);

                $post->categories()->attach($categories->random(2)->pluck('id'));
                $post->tags()->attach($tags->random(3)->pluck('id'));

                for ($j = 0; $j < 2; $j++) {
                    $comment = Comment::create([
                        'post_id' => $post->id,
                        'user_id' => $users->random()->id,
                        'content' => "Comment {$j} on post {$i}",
                        'is_approved' => rand(0, 1),
                    ]);

                    $comment->tags()->attach($tags->random(2)->pluck('id'));
                }
            }
        }
    }
}
