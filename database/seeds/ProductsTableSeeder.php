<?php

use Illuminate\Database\Seeder;
use App\product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // shirts
        for ($i=1; $i <= 30; $i++) {
            Product::create([
                'name' => 'supreme shirt '.$i,
                'slug' => 'shirts'.$i,
                'details' => 'Artikel',
                'price' => rand(14999, 24999),
                'description' =>'Lorem '. $i . ' This fabric is made of 100% organic light twill cotton from Germany. Twill is a type of textile weave with a pattern of diagonal parallel ribs. Because of this structure, twill generally drapes well and the garments falls elegant and smooth.',

            ])->categories()->attach(1);
        }

        $product = Product::find(1);
        $product->categories()->attach(2);


        // long sleeve
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'supreme long sleeve ' . $i,
                'slug' => 'sleeve' . $i,
                'details' => 'Artikel',
                'price' => rand(24999, 44999),
                'description' => 'Lorem ' . $i . 'This fabric is made of 100% organic light twill cotton from Germany. Twill is a type of textile weave with a pattern of diagonal parallel ribs. Because of this structure, twill generally drapes well and the garments falls elegant and smooth.',
            ])->categories()->attach(2);
        }

        // shorts
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'supreme short ' . $i,
                'slug' => 'shorts' . $i,
                'details' => 'Artikel',
                'price' => rand(24999, 44999),
                'description' => 'Lorem ' . $i . 'This fabric is made of 100% organic light twill cotton from Germany. Twill is a type of textile weave with a pattern of diagonal parallel ribs. Because of this structure, twill generally drapes well and the garments falls elegant and smooth.',
            ])->categories()->attach(3);
        }
        // hoodie
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'supreme hoodie ' . $i,
                'slug' => 'hoodie' . $i,
                'details' => 'Artikel',
                'price' => rand(7999, 14999),
                'description' => 'Lorem ' . $i . 'This fabric is made of 100% organic light twill cotton from Germany. Twill is a type of textile weave with a pattern of diagonal parallel ribs. Because of this structure, twill generally drapes well and the garments falls elegant and smooth.',
            ])->categories()->attach(4);
        }
    }
}
