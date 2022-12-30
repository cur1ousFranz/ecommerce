<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::factory(1)->create();

        DB::table('categories')->insert([
            'name' => 'Women',
            'parent_id' => null
        ]);

        DB::table('categories')->insert([
            'name' => 'Men',
            'parent_id' => null
        ]);

        DB::table('categories')->insert([
            'name' => 'Kids',
            'parent_id' => null
        ]);

        DB::table('categories')->insert([   //4
            'name' => 'Dresses',
            'parent_id' => 1
        ]);

        DB::table('categories')->insert([   //5
            'name' => 'Tops',
            'parent_id' => 1
        ]);

        DB::table('categories')->insert([   //6
            'name' => 'Bottoms',
            'parent_id' => 1
        ]);

        DB::table('categories')->insert([   //7
            'name' => 'Two-Piece',
            'parent_id' => 1
        ]);

        DB::table('categories')->insert([   //8
            'name' => 'Jumpsuits',
            'parent_id' => 1
        ]);

        DB::table('categories')->insert([   //9
            'name' => 'Activewear',
            'parent_id' => 1
        ]);

        DB::table('categories')->insert([   //10
            'name' => 'Lingerie & Loungewear',
            'parent_id' => 1
        ]);

        DB::table('categories')->insert([   //11
            'name' => 'Accessories & Jewelry',
            'parent_id' => 1
        ]);

        DB::table('categories')->insert([   //12
            'name' => 'Shoes & Bags',
            'parent_id' => 1
        ]);

        DB::table('categories')->insert([   //13
            'name' => 'Plus Size',
            'parent_id' => 1
        ]);

        // MEN
        DB::table('categories')->insert([  //14
            'name' => 'Tops',
            'parent_id' => 2
        ]);

        DB::table('categories')->insert([  //15
            'name' => 'Bottoms',
            'parent_id' => 2
        ]);

        DB::table('categories')->insert([   //16
            'name' => 'Co-ords',
            'parent_id' => 2
        ]);

        DB::table('categories')->insert([   //17
            'name' => 'Denim',
            'parent_id' => 2
        ]);

        DB::table('categories')->insert([   //18
            'name' => 'Activewear',
            'parent_id' => 2
        ]);

        DB::table('categories')->insert([   //19
            'name' => 'Extended Size',
            'parent_id' => 2
        ]);

        DB::table('categories')->insert([   //20
            'name' => 'Hoodie & Sweatshirts',
            'parent_id' => 2
        ]);

        DB::table('categories')->insert([   //21
            'name' => 'Knitwear',
            'parent_id' => 2
        ]);

        DB::table('categories')->insert([   //22
            'name' => 'Underwear & Sleepwear',
            'parent_id' => 2
        ]);

        DB::table('categories')->insert([   //23
            'name' => 'Shoes & Bags',
            'parent_id' => 2
        ]);

        DB::table('categories')->insert([   //24
            'name' => 'Accessories & Jewelry',
            'parent_id' => 2
        ]);

        DB::table('categories')->insert([   //25
            'name' => 'Shoes & Bags',
            'parent_id' => 2
        ]);

        DB::table('categories')->insert([   //26
            'name' => 'Outerwear',
            'parent_id' => 2
        ]);

        // KIDS

        DB::table('categories')->insert([   //27
            'name' => 'Baby',
            'parent_id' => 3
        ]);

        DB::table('categories')->insert([   //28
            'name' => 'Toddler Boys',
            'parent_id' => 3
        ]);

        DB::table('categories')->insert([   //29
            'name' => 'Toddler Girls',
            'parent_id' => 3
        ]);

        DB::table('categories')->insert([   //30
            'name' => 'Boys',
            'parent_id' => 3
        ]);

        DB::table('categories')->insert([   //31
            'name' => 'Girls',
            'parent_id' => 3
        ]);

        DB::table('categories')->insert([   //32
            'name' => 'Bags',
            'parent_id' => 3
        ]);

        DB::table('categories')->insert([   //33
            'name' => 'Accessories & Jewelry',
            'parent_id' => 3
        ]);

        DB::table('categories')->insert([   //34
            'name' => 'Shoes',
            'parent_id' => 3
        ]);

        DB::table('categories')->insert([   //35
            'name' => 'Maternity',
            'parent_id' => 3
        ]);

        DB::table('categories')->insert([   //36
            'name' => 'Mommy & Me',
            'parent_id' => 3
        ]);

        // ATTRIBUTES

        DB::table('attributes')->insert([   //1
            'name' => 'Activity',
        ]);

        DB::table('attributes')->insert([   //2
            'name' => 'Age',
        ]);

        DB::table('attributes')->insert([   //3
            'name' => 'Bag Size',
        ]);

        DB::table('attributes')->insert([   //4
            'name' => 'Bra Type',
        ]);

        DB::table('attributes')->insert([   //5
            'name' => 'Bottom Type',
        ]);

        DB::table('attributes')->insert([   //6
            'name' => 'Category',
        ]);

        DB::table('attributes')->insert([   //7
            'name' => 'Closure Type',
        ]);

        DB::table('attributes')->insert([   //8
            'name' => 'Color',
        ]);

        DB::table('attributes')->insert([   //9
            'name' => 'Details',
        ]);

        DB::table('attributes')->insert([   //10
            'name' => 'Fabric',
        ]);

        DB::table('attributes')->insert([   //11
            'name' => 'Features',
        ]);

        DB::table('attributes')->insert([   //12
            'name' => 'Fit Type',
        ]);

        DB::table('attributes')->insert([   //13
            'name' => 'Length',
        ]);

        DB::table('attributes')->insert([   //14
            'name' => 'Material',
        ]);

        DB::table('attributes')->insert([   //15
            'name' => 'Neckline',
        ]);

        DB::table('attributes')->insert([   //16
            'name' => 'Number of Pieces',
        ]);

        DB::table('attributes')->insert([   //17
            'name' => 'Pattern Type',
        ]);

        DB::table('attributes')->insert([   //18
            'name' => 'Size',
        ]);

        DB::table('attributes')->insert([   //19
            'name' => 'Sleeve Length',
        ]);

        DB::table('attributes')->insert([   //20
            'name' => 'Sleeve Type',
        ]);

        DB::table('attributes')->insert([   //21
            'name' => 'Style',
        ]);

        DB::table('attributes')->insert([   //22
            'name' => 'Support',
        ]);

        DB::table('attributes')->insert([   //23
            'name' => 'Top Type',
        ]);

        DB::table('attributes')->insert([   //24
            'name' => 'Type',
        ]);

        DB::table('attributes')->insert([   //25
            'name' => 'Waist Line',
        ]);

        // PIVOT TABLE

        /** DRESSES */
        DB::table('attribute_category')->insert([
            'attribute_id' => 14,
            'category_id' => 4
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 24,
            'category_id' => 4
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 4
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 20,
            'category_id' => 4
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 19,
            'category_id' => 4
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 4
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 4
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 15,
            'category_id' => 4
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 13,
            'category_id' => 4
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 4
        ]);

        /** TOPS */

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 5
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 14,
            'category_id' => 5
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 24,
            'category_id' => 5
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 5
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 20,
            'category_id' => 5
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 19,
            'category_id' => 5
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 5
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 5
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 15,
            'category_id' => 5
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 13,
            'category_id' => 5
        ]);

        // BOTTOMS

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 6
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 14,
            'category_id' => 6
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 24,
            'category_id' => 6
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 6
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 6
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 6
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 13,
            'category_id' => 6
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 6
        ]);

        // TWO-PIECE

        DB::table('attribute_category')->insert([
            'attribute_id' => 23,
            'category_id' => 7
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 5,
            'category_id' => 7
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 14,
            'category_id' => 7
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 7
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 19,
            'category_id' => 7
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 7
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 7
        ]);

        // JUMPSUITS

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 8
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 14,
            'category_id' => 8
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 24,
            'category_id' => 8
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 8
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 19,
            'category_id' => 8
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 8
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 8
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 15,
            'category_id' => 8
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 13,
            'category_id' => 8
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 8
        ]);

        // ACTIVEWEAR

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 9
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 1,
            'category_id' => 9
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 22,
            'category_id' => 9
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 11,
            'category_id' => 9
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 4,
            'category_id' => 9
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 25,
            'category_id' => 9
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 24,
            'category_id' => 9
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 9
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 9
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 13,
            'category_id' => 9
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 12,
            'category_id' => 9
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 10,
            'category_id' => 9
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 9
        ]);

        // LINGERIE & LOUNGEWEAR

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 10
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 16,
            'category_id' => 10
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 14,
            'category_id' => 10
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 24,
            'category_id' => 10
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 19,
            'category_id' => 10
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 10
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 10
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 15,
            'category_id' => 10
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 9,
            'category_id' => 10
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 10
        ]);

        // Accessories & Jewelry

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 11
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 11
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 24,
            'category_id' => 11
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 14,
            'category_id' => 11
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 11
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 11
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 9,
            'category_id' => 11
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 11
        ]);

        // Shoes & Bags

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 12
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 12
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 14,
            'category_id' => 12
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 12
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 12
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 9,
            'category_id' => 12
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 24,
            'category_id' => 12
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 12
        ]);

        // Plus Size

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 13
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 14,
            'category_id' => 13
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 24,
            'category_id' => 13
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 13
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 19,
            'category_id' => 13
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 13
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 13
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 15,
            'category_id' => 13
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 13,
            'category_id' => 13
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 9,
            'category_id' => 13
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 13
        ]);

        // MEN ATTRIBUTES

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 14
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 14,
            'category_id' => 14
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 14
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 20,
            'category_id' => 14
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 19,
            'category_id' => 14
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 14
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 14
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 15,
            'category_id' => 14
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 13,
            'category_id' => 14
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 12,
            'category_id' => 14
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 14
        ]);

        // Bottoms

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 15
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 12,
            'category_id' => 15
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 14,
            'category_id' => 15
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 9,
            'category_id' => 15
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 15
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 24,
            'category_id' => 15
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 15
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 7,
            'category_id' => 15
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 15
        ]);

        //  Co-ords

        DB::table('attribute_category')->insert([
            'attribute_id' => 23,
            'category_id' => 16
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 5,
            'category_id' => 16
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 16
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 19,
            'category_id' => 16
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 16
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 14,
            'category_id' => 16
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 16
        ]);

        // Denim

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 17
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 24,
            'category_id' => 17
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 17
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 17
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 17
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 13,
            'category_id' => 17
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 12,
            'category_id' => 17
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 9,
            'category_id' => 17
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 17
        ]);

        // Activewear

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 18
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 1,
            'category_id' => 18
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 11,
            'category_id' => 18
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 25,
            'category_id' => 18
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 18
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 18
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 18
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 13,
            'category_id' => 18
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 12,
            'category_id' => 18
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 10,
            'category_id' => 18
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 18
        ]);

        // Extended Size

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 19
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 14,
            'category_id' => 19
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 25,
            'category_id' => 19
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 19
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 20,
            'category_id' => 19
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 19,
            'category_id' => 19
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 19
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 19
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 19
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 13,
            'category_id' => 19
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 12,
            'category_id' => 19
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 9,
            'category_id' => 19
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 19
        ]);

        //  Hoodie & Sweatshirts

        DB::table('attribute_category')->insert([
            'attribute_id' => 12,
            'category_id' => 20
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 24,
            'category_id' => 20
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 20
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 20
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 15,
            'category_id' => 20
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 20,
            'category_id' => 20
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 14,
            'category_id' => 20
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 20
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 20
        ]);

        // Knitwear

        DB::table('attribute_category')->insert([
            'attribute_id' => 12,
            'category_id' => 21
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 24,
            'category_id' => 21
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 21
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 21
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 9,
            'category_id' => 21
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 15,
            'category_id' => 21
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 14,
            'category_id' => 21
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 21
        ]);

        //  Underwear & Sleepwear

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 22
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 16,
            'category_id' => 22
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 14,
            'category_id' => 22
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 24,
            'category_id' => 22
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 19,
            'category_id' => 22
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 22
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 22
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 15,
            'category_id' => 22
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 9,
            'category_id' => 22
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 22
        ]);

        // Shoes & Bags

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 23
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 23
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 23
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 14,
            'category_id' => 23
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 23
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 23
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 9,
            'category_id' => 23
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 23
        ]);

        // Accessories & Jewelry

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 24
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 24
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 24
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 14,
            'category_id' => 24
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 24
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 24
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 9,
            'category_id' => 24
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 24,
            'category_id' => 24
        ]);

        // Outerwear

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 25
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 25
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 24,
            'category_id' => 25
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 14,
            'category_id' => 25
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 13,
            'category_id' => 25
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 9,
            'category_id' => 25
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 25
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 15,
            'category_id' => 25
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 25
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 25
        ]);

        // KIDS ATTRIBUTES

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 26
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 2,
            'category_id' => 26
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 26
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 26
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 26
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 23,
            'category_id' => 26
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 5,
            'category_id' => 26
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 26
        ]);

        // Toddler Boys

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 27
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 2,
            'category_id' => 27
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 27
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 23,
            'category_id' => 27
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 5,
            'category_id' => 27
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 27
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 27
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 27
        ]);

        // Toddler Girls

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 28
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 2,
            'category_id' => 28
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 28
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 23,
            'category_id' => 28
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 5,
            'category_id' => 28
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 28
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 28
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 28
        ]);

        // Boys

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 29
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 2,
            'category_id' => 29
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 29
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 23,
            'category_id' => 29
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 5,
            'category_id' => 29
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 29
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 29
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 29
        ]);

        // Girls

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 30
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 2,
            'category_id' => 30
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 30
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 23,
            'category_id' => 30
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 5,
            'category_id' => 30
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 30
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 30
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 30
        ]);

        // Bags

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 31
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 3,
            'category_id' => 31
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 31
        ]);

        // Accessories & Jewelry

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 32
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 32
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 14,
            'category_id' => 32
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 32
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 32
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 9,
            'category_id' => 32
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 24,
            'category_id' => 32
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 32
        ]);

        // Shoes

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 33
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 33
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 14,
            'category_id' => 33
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 33
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 33
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 9,
            'category_id' => 33
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 24,
            'category_id' => 33
        ]);

        // Maternity

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 34
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 34
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 34
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 34
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 9,
            'category_id' => 34
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 24,
            'category_id' => 34
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 19,
            'category_id' => 34
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 13,
            'category_id' => 34
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 15,
            'category_id' => 34
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 34
        ]);

        // Mommy & Me

        DB::table('attribute_category')->insert([
            'attribute_id' => 6,
            'category_id' => 35
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 18,
            'category_id' => 35
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 35
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 17,
            'category_id' => 35
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 21,
            'category_id' => 35
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 9,
            'category_id' => 35
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 24,
            'category_id' => 35
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 9,
            'category_id' => 35
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 13,
            'category_id' => 35
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 15,
            'category_id' => 35
        ]);

        DB::table('attribute_category')->insert([
            'attribute_id' => 8,
            'category_id' => 35
        ]);
    }
}
