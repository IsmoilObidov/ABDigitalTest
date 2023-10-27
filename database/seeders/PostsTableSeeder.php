<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10000; $i++) {
            $randomDate = Carbon::create(
                random_int(2022, 2024), // Random year between 2022 and 2024
                random_int(1, 12),     // Random month between 1 and 12
                random_int(1, 28),     // Random day between 1 and 28
            );

            DB::table('posts')->insert([
                'title' => 'Post ' . $i,
                'content' => 'This is the content of post ' . $i,
                'published_at' => $randomDate,
            ]);
        }
    }
}
