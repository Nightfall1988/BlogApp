<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;
use Faker\Factory as Faker;

class CategoryPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $categoryIds = Category::pluck('id')->toArray();
        $postIds = Post::pluck('id')->toArray();

        foreach ($postIds as $postId) {
            $numberOfCategories = $faker->numberBetween(1, 5);
            $selectedCategoryIds = $faker->randomElements($categoryIds, $numberOfCategories);

            foreach ($selectedCategoryIds as $categoryId) {
                DB::table('category_post')->insert([
                    'category_id' => $categoryId,
                    'post_id' => $postId,
                    'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
