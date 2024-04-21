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

        // foreach (range(1, 20) as $index) {
            $user_id = $faker->randomElement($userIds);

            Post::create([
                'title' => 'I should have loved biology',
                'content' => 'In the textbooks, astonishing facts were presented without astonishment. Someone probably told me that every cell in my body has the same DNA. But no one shook me by the shoulders, saying how crazy that was. I needed Lewis Thomas, who wrote in The Medusa and the Snail',
                'user_id' => $user_id,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);

            $user_id = $faker->randomElement($userIds);
            Post::create([
                'title' => 'Lossless Acceleration of Large Language Model via Adaptive N-gram Parallel Decoding',
                'content' => 'While Large Language Models (LLMs) have shown remarkable abilities, they are hindered by significant resource consumption and considerable latency due to autoregressive processing. In this study, we introduce Adaptive N-gram Parallel Decoding (ANPD), an innovative and lossless approach that accelerates inference by allowing the simultaneous generation of multiple tokens.',
                'user_id' => $user_id,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);

            $user_id = $faker->randomElement($userIds);
            Post::create([
                'title' => 'THE FADING MEMORIES OF YOUTH',
                'content' => 'You might think you remember taking a trip to Disneyland when you were 18 months old, or that time you had chickenpox when you were 2—but you almost certainly don’t. However real they may seem, your earliest treasured memories were probably implanted by seeing photos or hearing your parents’ stories about waiting in line for the spinning teacups.',
                'user_id' => $user_id,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);

            $user_id = $faker->randomElement($userIds);
            Post::create([
                'title' => 'Coroutines and effects',
                'content' => 'In the textbooks, astonishing facts were presented without astonishment. Someone probably told me that every cell in my body has the same DNA. But no one shook me by the shoulders, saying how crazy that was. I needed Lewis Thomas, who wrote in The Medusa and the Snail',
                'user_id' => $user_id,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);

            Post::create([
                'title' => 'Has Llama-3 just killed proprietary AI models?',
                'content' => 'Meta released Llama-3 only three days ago, and it already feels like the inflection point when open source models finally closed the gap with proprietary models. The benchmarks show that Llama-3 70B matches GPT-4 and Claude Opus in most tasks, and the even more powerful Llama-3 400B+ model is still training.',
                'user_id' => $user_id,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);

            Post::create([
                'title' => 'The dangers of “decentralized” ID systems',
                'content' => 'Many decentralized identity protocols are being developed, which claim to increase users’ privacy, enable interoperability and convenient single sign-ons, protect against identity theft and allow self-sovereign ownership of data.',
                'user_id' => $user_id,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);
        // }
    }
}
