<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
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

        foreach (range(1, 20) as $index) {
            $user_id = $faker->randomElement($userIds);

            Post::create([
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'user_id' => $user_id,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}
