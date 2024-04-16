<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Faker\Factory as Faker;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $userIds = User::pluck('id')->toArray();
        $postIds = Post::pluck('id')->toArray();

        foreach (range(1, 50) as $index) {
            $user_id = $faker->randomElement($userIds);
            $post_id = $faker->randomElement($postIds);

            Comment::create([
                'body' => $faker->paragraph,
                'user_id' => $user_id,
                'post_id' => $post_id,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}
