<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use function random_int;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        News::query()->delete();
        News::factory(random_int(20, 30))->create();
    }
}
