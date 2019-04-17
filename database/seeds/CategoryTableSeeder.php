<?php

use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class  CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();/*seed voor categorie*/
        Category::insert([
            ['name' => 'jacket', 'slug' => 'jacket', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'long sleeve', 'slug' => 'longsleeve', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'shorts', 'slug' => 'shorts', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'hoodie', 'slug' => 'hoodie', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
