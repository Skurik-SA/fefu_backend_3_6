<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use function random_int;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        Page::query()->delete();
        Page::factory(random_int(20, 30))->create();
    }
}
