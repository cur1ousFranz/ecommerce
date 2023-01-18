<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Attribute;
use App\Models\Category;
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

        $women = Category::create([
            'name' => 'Women',
            'parent_id' => null
        ]);

        $men = Category::create([
            'name' => 'Men',
            'parent_id' => null
        ]);

        $kids = Category::create([
            'name' => 'Kids',
            'parent_id' => null
        ]);

        // WOMEN
        $dresses = $women->children()->create([
            'name' => 'Dresses',
            'slug' => 'women-dresses',
            'icon' => '/img/women/Dresses.png'
        ]);
        $womenTops = $women->children()->create([
            'name' => 'Tops',
            'slug' => 'women-tops',
            'icon' => '/img/women/Tops.png'
        ]);
        $womenBottoms = $women->children()->create([
            'name' => 'Bottoms',
            'slug' => 'women-bottoms',
            'icon' => '/img/women/Bottoms.png'
        ]);
        $twoPiece = $women->children()->create([
            'name' => 'Two-Piece',
            'slug' => 'women-two-piece',
            'icon' => '/img/women/Two-Piece.png'
        ]);
        $jumpSuits = $women->children()->create([
            'name' => 'Jumpsuits',
            'slug' => 'women-jumpsuits',
            'icon' => '/img/women/Jumpsuits.png'
        ]);
        $womenActiveWear = $women->children()->create([
            'name' => 'Activewear',
            'slug' => 'women-activewear',
            'icon' => '/img/women/Activewear.png'
        ]);
        $lingerie = $women->children()->create([
            'name' => 'Lingerie & Loungewear',
            'slug' => 'women-lingerie-&-loungewear',
            'icon' => '/img/women/Lingerie.png'
        ]);
        $womenAccs = $women->children()->create([
            'name' => 'Accessories & Jewelry',
            'slug' => 'women-accessories-&-jewelry',
            'icon' => '/img/women/Accessories.png'
        ]);
        $womenShoeBag = $women->children()->create([
            'name' => 'Shoes & Bags',
            'slug' => 'women-shoes-&-bags',
            'icon' => '/img/women/ShoesBags.png'
        ]);
        $plusSize = $women->children()->create([
            'name' => 'Plus Size',
            'slug' => 'women-plus-size',
            'icon' => '/img/women/PlusSize.png'
        ]);

        // MEN
        $menTops = $men->children()->create([
            'name' => 'Tops',
            'slug' => 'men-tops',
            'icon' => '/img/men/Tops.png'
        ]);
        $menBottoms = $men->children()->create([
            'name' => 'Bottoms',
            'slug' => 'men-bottoms',
            'icon' => '/img/men/Bottoms.png'
        ]);
        $co_ords = $men->children()->create([
            'name' => 'Co-ords',
            'slug' => 'men-co-ords',
            'icon' => '/img/men/Co-ords.png'
        ]);
        $denim = $men->children()->create([
            'name' => 'Denim',
            'slug' => 'men-denim',
            'icon' => '/img/men/Denim.png'
        ]);
        $menActiveWear = $men->children()->create([
            'name' => 'Activewear',
            'slug' => 'men-activewear',
            'icon' => '/img/men/Activewear.png'
        ]);
        $extendedSize = $men->children()->create([
            'name' => 'Extended Size',
            'slug' => 'men-extended-size',
            'icon' => '/img/men/Extended.png'
        ]);
        $hoodieSweat = $men->children()->create([
            'name' => 'Hoodie & Sweatshirts',
            'slug' => 'men-hoodie-&-sweatshirts',
            'icon' => '/img/men/Hoodies.png'
        ]);
        $knitWear = $men->children()->create([
            'name' => 'Knitwear',
            'slug' => 'men-knitwear',
            'icon' => '/img/men/Knitwear.png'
        ]);
        $underWear = $men->children()->create([
            'name' => 'Underwear & Sleepwear',
            'slug' => 'men-underwear-&-sleepwear',
            'icon' => '/img/men/Underwear.png'
        ]);
        $menShoeBag = $men->children()->create([
            'name' => 'Shoes & Bags',
            'slug' => 'men-shoes-&-bags',
            'icon' => '/img/men/ShoesBags.png'
        ]);
        $menAccs = $men->children()->create([
            'name' => 'Accessories & Jewelry',
            'slug' => 'men-accessories-&-jewelry',
            'icon' => '/img/men/Accessory.png'
        ]);
        $outerWear = $men->children()->create([
            'name' => 'Outerwear',
            'slug' => 'men-outerwear',
            'icon' => '/img/men/Outerwear.png'
        ]);

        // KIDS
        $baby = $kids->children()->create([
            'name' => 'Baby',
            'slug' => 'kids-baby',
            'icon' => '/img/kids/Baby.png'
        ]);
        $toddBoys = $kids->children()->create([
            'name' => 'Toddler Boys',
            'slug' => 'kids-toddler-boys',
            'icon' => '/img/kids/ToddlerBoy.png'
        ]);
        $toddGirls = $kids->children()->create([
            'name' => 'Toddler Girls',
            'slug' => 'kids-toddler-girls',
            'icon' => '/img/kids/ToddlerGirl.png'
        ]);
        $boys = $kids->children()->create([
            'name' => 'Boys',
            'slug' => 'kids-boys',
            'icon' => '/img/kids/Boy.png'
        ]);
        $girls = $kids->children()->create([
            'name' => 'Girls',
            'slug' => 'kids-toddler-girls',
            'icon' => '/img/kids/Girl.png'
        ]);
        $bags = $kids->children()->create([
            'name' => 'Bags',
            'slug' => 'kids-bags',
            'icon' => '/img/kids/Bags.png'
        ]);
        $kidsAccs = $kids->children()->create([
            'name' => 'Accessories & Jewelry',
            'slug' => 'kids-accessories-&-Jewelry',
            'icon' => '/img/kids/Accessory.png'
        ]);
        $kidsShoe = $kids->children()->create([
            'name' => 'Shoes',
            'slug' => 'kids-shoes',
            'icon' => '/img/kids/Shoes.png'
        ]);
        $maternity = $kids->children()->create([
            'name' => 'Maternity',
            'slug' => 'kids-maternity',
            'icon' => '/img/kids/Maternity.png',
        ]);
        $mommy = $kids->children()->create([
            'name' => 'Mommy & Me',
            'slug' => 'kids-mommy-&-me',
            'icon' => '/img/kids/MommyMe.png'
        ]);

        /** ATTRIBUTES | CATEGORY */

        // DRESSES
        $dresses->attributes()->create(['name' => 'Length']);
        $dresses->attributes()->create(['name' => 'Material']);
        $dresses->attributes()->create(['name' => 'Neckline']);
        $dresses->attributes()->create(['name' => 'Pattern Type']);
        $dresses->attributes()->create(['name' => 'Size']);
        $dresses->attributes()->create(['name' => 'Sleeve Length']);
        $dresses->attributes()->create(['name' => 'Sleeve Type']);
        $dresses->attributes()->create(['name' => 'Style']);
        $dresses->attributes()->create(['name' => 'Type']);
        $dresses->attributes()->create(['name' => 'Color']);

        // WOMEN TOPS
        $womenTops->attributes()->create(['name' => 'Category']);
        $womenTops->attributes()->create(['name' => 'Length']);
        $womenTops->attributes()->create(['name' => 'Material']);
        $womenTops->attributes()->create(['name' => 'Neckline']);
        $womenTops->attributes()->create(['name' => 'Pattern Type']);
        $womenTops->attributes()->create(['name' => 'Size']);
        $womenTops->attributes()->create(['name' => 'Sleeve Length']);
        $womenTops->attributes()->create(['name' => 'Sleeve Type']);
        $womenTops->attributes()->create(['name' => 'Style']);
        $womenTops->attributes()->create(['name' => 'Type']);
        $womenTops->attributes()->create(['name' => 'Color']);

        // WOMEN BOTTOMS
        $womenBottoms->attributes()->create(['name' => 'Category']);
        $womenBottoms->attributes()->create(['name' => 'Length']);
        $womenBottoms->attributes()->create(['name' => 'Material']);
        $womenBottoms->attributes()->create(['name' => 'Pattern Type']);
        $womenBottoms->attributes()->create(['name' => 'Size']);
        $womenBottoms->attributes()->create(['name' => 'Style']);
        $womenBottoms->attributes()->create(['name' => 'Type']);
        $womenBottoms->attributes()->create(['name' => 'Color']);

        // TWO-PIECE
        $twoPiece->attributes()->create(['name' => 'Bottom Type']);
        $twoPiece->attributes()->create(['name' => 'Material']);
        $twoPiece->attributes()->create(['name' => 'Pattern Type']);
        $twoPiece->attributes()->create(['name' => 'Size']);
        $twoPiece->attributes()->create(['name' => 'Style']);
        $twoPiece->attributes()->create(['name' => 'Top Type']);
        $twoPiece->attributes()->create(['name' => 'Color']);

        // JUMPSUITS
        $jumpSuits->attributes()->create(['name' => 'Category']);
        $jumpSuits->attributes()->create(['name' => 'Length']);
        $jumpSuits->attributes()->create(['name' => 'Material']);
        $jumpSuits->attributes()->create(['name' => 'Neckline']);
        $jumpSuits->attributes()->create(['name' => 'Pattern Type']);
        $jumpSuits->attributes()->create(['name' => 'Size']);
        $jumpSuits->attributes()->create(['name' => 'Sleeve Length']);
        $jumpSuits->attributes()->create(['name' => 'Style']);
        $jumpSuits->attributes()->create(['name' => 'Type']);
        $jumpSuits->attributes()->create(['name' => 'Color']);

        // WOMEN ACTIVEWEAR
        $womenActiveWear->attributes()->create(['name' => 'Activity']);
        $womenActiveWear->attributes()->create(['name' => 'Bra Type']);
        $womenActiveWear->attributes()->create(['name' => 'Category']);
        $womenActiveWear->attributes()->create(['name' => 'Fabric']);
        $womenActiveWear->attributes()->create(['name' => 'Features']);
        $womenActiveWear->attributes()->create(['name' => 'Fit Type']);
        $womenActiveWear->attributes()->create(['name' => 'Length']);
        $womenActiveWear->attributes()->create(['name' => 'Pattern Type']);
        $womenActiveWear->attributes()->create(['name' => 'Size']);
        $womenActiveWear->attributes()->create(['name' => 'Support']);
        $womenActiveWear->attributes()->create(['name' => 'Type']);
        $womenActiveWear->attributes()->create(['name' => 'Waist Line']);
        $womenActiveWear->attributes()->create(['name' => 'Color']);

        // LINGERIE & LOUNGEWEAR
        $lingerie->attributes()->create(['name' => 'Category']);
        $lingerie->attributes()->create(['name' => 'Details']);
        $lingerie->attributes()->create(['name' => 'Material']);
        $lingerie->attributes()->create(['name' => 'Neckline']);
        $lingerie->attributes()->create(['name' => 'Number or Pieces']);
        $lingerie->attributes()->create(['name' => 'Pattern Type']);
        $lingerie->attributes()->create(['name' => 'Size']);
        $lingerie->attributes()->create(['name' => 'Sleeve Length']);
        $lingerie->attributes()->create(['name' => 'Type']);
        $lingerie->attributes()->create(['name' => 'Color']);

        // ACCESSORIES & JEWELRY
        $womenAccs->attributes()->create(['name' => 'Category']);
        $womenAccs->attributes()->create(['name' => 'Details']);
        $womenAccs->attributes()->create(['name' => 'Material']);
        $womenAccs->attributes()->create(['name' => 'Pattern Style']);
        $womenAccs->attributes()->create(['name' => 'Pattern Type']);
        $womenAccs->attributes()->create(['name' => 'Size']);
        $womenAccs->attributes()->create(['name' => 'Type']);
        $womenAccs->attributes()->create(['name' => 'Color']);

        // SHOES & BAGS
        $womenShoeBag->attributes()->create(['name' => 'Category']);
        $womenShoeBag->attributes()->create(['name' => 'Material']);
        $womenShoeBag->attributes()->create(['name' => 'Pattern Details']);
        $womenShoeBag->attributes()->create(['name' => 'Pattern Style']);
        $womenShoeBag->attributes()->create(['name' => 'Pattern Type']);
        $womenShoeBag->attributes()->create(['name' => 'Size']);
        $womenShoeBag->attributes()->create(['name' => 'Type']);
        $womenShoeBag->attributes()->create(['name' => 'Color']);

        // PLUS SIZE
        $plusSize->attributes()->create(['name' => 'Category']);
        $plusSize->attributes()->create(['name' => 'Details']);
        $plusSize->attributes()->create(['name' => 'Length']);
        $plusSize->attributes()->create(['name' => 'Material']);
        $plusSize->attributes()->create(['name' => 'Neckline']);
        $plusSize->attributes()->create(['name' => 'Pattern Type']);
        $plusSize->attributes()->create(['name' => 'Size']);
        $plusSize->attributes()->create(['name' => 'Sleeve Length']);
        $plusSize->attributes()->create(['name' => 'Style']);
        $plusSize->attributes()->create(['name' => 'Type']);
        $plusSize->attributes()->create(['name' => 'Color']);

        /** MEN */

        // MEN TOPS
        $menTops->attributes()->create(['name' => 'Category']);
        $menTops->attributes()->create(['name' => 'Fit Type']);
        $menTops->attributes()->create(['name' => 'Length']);
        $menTops->attributes()->create(['name' => 'Material']);
        $menTops->attributes()->create(['name' => 'Neckline']);
        $menTops->attributes()->create(['name' => 'Pattern Type']);
        $menTops->attributes()->create(['name' => 'Size']);
        $menTops->attributes()->create(['name' => 'Sleeve Length']);
        $menTops->attributes()->create(['name' => 'Sleeve Type']);
        $menTops->attributes()->create(['name' => 'Style']);
        $menTops->attributes()->create(['name' => 'Color']);

        // MEN BOTTOMS
        $menBottoms->attributes()->create(['name' => 'Category']);
        $menBottoms->attributes()->create(['name' => 'Closure Type']);
        $menBottoms->attributes()->create(['name' => 'Details']);
        $menBottoms->attributes()->create(['name' => 'Fit Type']);
        $menBottoms->attributes()->create(['name' => 'Material']);
        $menBottoms->attributes()->create(['name' => 'Pattern Type']);
        $menBottoms->attributes()->create(['name' => 'Size']);
        $menBottoms->attributes()->create(['name' => 'Type']);
        $menBottoms->attributes()->create(['name' => 'Color']);

        // CO-ORDS
        $co_ords->attributes()->create(['name' => 'Bottom Type']);
        $co_ords->attributes()->create(['name' => 'Material']);
        $co_ords->attributes()->create(['name' => 'Pattern Type']);
        $co_ords->attributes()->create(['name' => 'Size']);
        $co_ords->attributes()->create(['name' => 'Sleeve Length']);
        $co_ords->attributes()->create(['name' => 'Style']);
        $co_ords->attributes()->create(['name' => 'Top Type']);
        $co_ords->attributes()->create(['name' => 'Color']);

        // DENIM
        $denim->attributes()->create(['name' => 'Category']);
        $denim->attributes()->create(['name' => 'Details']);
        $denim->attributes()->create(['name' => 'Fit Type']);
        $denim->attributes()->create(['name' => 'Length']);
        $denim->attributes()->create(['name' => 'Pattern Type']);
        $denim->attributes()->create(['name' => 'Size']);
        $denim->attributes()->create(['name' => 'Style']);
        $denim->attributes()->create(['name' => 'Type']);
        $denim->attributes()->create(['name' => 'Color']);

        // MEN ACTIVEWEAR
        $menActiveWear->attributes()->create(['name' => 'Activity']);
        $menActiveWear->attributes()->create(['name' => 'Category']);
        $menActiveWear->attributes()->create(['name' => 'Fabric']);
        $menActiveWear->attributes()->create(['name' => 'Features']);
        $menActiveWear->attributes()->create(['name' => 'Fit Type']);
        $menActiveWear->attributes()->create(['name' => 'Length']);
        $menActiveWear->attributes()->create(['name' => 'Pattern Type']);
        $menActiveWear->attributes()->create(['name' => 'Size']);
        $menActiveWear->attributes()->create(['name' => 'Type']);
        $menActiveWear->attributes()->create(['name' => 'Waist Line']);
        $menActiveWear->attributes()->create(['name' => 'Color']);

        // EXTENDED SIZE
        $extendedSize->attributes()->create(['name' => 'Category']);
        $extendedSize->attributes()->create(['name' => 'Details']);
        $extendedSize->attributes()->create(['name' => 'Fit Type']);
        $extendedSize->attributes()->create(['name' => 'Length']);
        $extendedSize->attributes()->create(['name' => 'Material']);
        $extendedSize->attributes()->create(['name' => 'Neckline']);
        $extendedSize->attributes()->create(['name' => 'Pattern Type']);
        $extendedSize->attributes()->create(['name' => 'Size']);
        $extendedSize->attributes()->create(['name' => 'Sleeve Length']);
        $extendedSize->attributes()->create(['name' => 'Sleeve Type']);
        $extendedSize->attributes()->create(['name' => 'Style']);
        $extendedSize->attributes()->create(['name' => 'Waist Line']);
        $extendedSize->attributes()->create(['name' => 'Color']);

        // HOODIE & SWEATSHIRTS
        $hoodieSweat->attributes()->create(['name' => 'Fit Type']);
        $hoodieSweat->attributes()->create(['name' => 'Material']);
        $hoodieSweat->attributes()->create(['name' => 'Neckline']);
        $hoodieSweat->attributes()->create(['name' => 'Pattern Type']);
        $hoodieSweat->attributes()->create(['name' => 'Size']);
        $hoodieSweat->attributes()->create(['name' => 'Sleeve Type']);
        $hoodieSweat->attributes()->create(['name' => 'Style']);
        $hoodieSweat->attributes()->create(['name' => 'Type']);
        $hoodieSweat->attributes()->create(['name' => 'Color']);

        // KNITWEAR
        $knitWear->attributes()->create(['name' => 'Details']);
        $knitWear->attributes()->create(['name' => 'Fit Type']);
        $knitWear->attributes()->create(['name' => 'Material']);
        $knitWear->attributes()->create(['name' => 'Neckline']);
        $knitWear->attributes()->create(['name' => 'Pattern Type']);
        $knitWear->attributes()->create(['name' => 'Size']);
        $knitWear->attributes()->create(['name' => 'Style']);
        $knitWear->attributes()->create(['name' => 'Type']);
        $knitWear->attributes()->create(['name' => 'Color']);

        // UNDERWEAR & SLEEPWEAR
        $underWear->attributes()->create(['name' => 'Category']);
        $underWear->attributes()->create(['name' => 'Details']);
        $underWear->attributes()->create(['name' => 'Material']);
        $underWear->attributes()->create(['name' => 'Neckline']);
        $underWear->attributes()->create(['name' => 'Number Of Pieces']);
        $underWear->attributes()->create(['name' => 'Pattern Type']);
        $underWear->attributes()->create(['name' => 'Size']);
        $underWear->attributes()->create(['name' => 'Sleeve Length']);
        $underWear->attributes()->create(['name' => 'Type']);
        $underWear->attributes()->create(['name' => 'Color']);

        // MEN SHOE & BAGS
        $menShoeBag->attributes()->create(['name' => 'Category']);
        $menShoeBag->attributes()->create(['name' => 'Details']);
        $menShoeBag->attributes()->create(['name' => 'Material']);
        $menShoeBag->attributes()->create(['name' => 'Pattern Type']);
        $menShoeBag->attributes()->create(['name' => 'Size']);
        $menShoeBag->attributes()->create(['name' => 'Style']);
        $menShoeBag->attributes()->create(['name' => 'Type']);
        $menShoeBag->attributes()->create(['name' => 'Color']);

        // MEN ACCESSORIES & JEWELRY
        $menAccs->attributes()->create(['name' => 'Category']);
        $menAccs->attributes()->create(['name' => 'Details']);
        $menAccs->attributes()->create(['name' => 'Material']);
        $menAccs->attributes()->create(['name' => 'Pattern Type']);
        $menAccs->attributes()->create(['name' => 'Size']);
        $menAccs->attributes()->create(['name' => 'Style']);
        $menAccs->attributes()->create(['name' => 'Type']);
        $menAccs->attributes()->create(['name' => 'Color']);

        // OUTERWEAR
        $outerWear->attributes()->create(['name' => 'Category']);
        $outerWear->attributes()->create(['name' => 'Details']);
        $outerWear->attributes()->create(['name' => 'Length']);
        $outerWear->attributes()->create(['name' => 'Material']);
        $outerWear->attributes()->create(['name' => 'Neckline']);
        $outerWear->attributes()->create(['name' => 'Pattern Type']);
        $outerWear->attributes()->create(['name' => 'Size']);
        $outerWear->attributes()->create(['name' => 'Style']);
        $outerWear->attributes()->create(['name' => 'Type']);
        $outerWear->attributes()->create(['name' => 'Color']);

        /** KIDS */

        // BABY
        $baby->attributes()->create(['name' => 'Age']);
        $baby->attributes()->create(['name' => 'Bottom Type']);
        $baby->attributes()->create(['name' => 'Category']);
        $baby->attributes()->create(['name' => 'Pattern Type']);
        $baby->attributes()->create(['name' => 'Size']);
        $baby->attributes()->create(['name' => 'Style']);
        $baby->attributes()->create(['name' => 'Top Type']);
        $baby->attributes()->create(['name' => 'Color']);

        // TODDLER BOYS
        $toddBoys->attributes()->create(['name' => 'Age']);
        $toddBoys->attributes()->create(['name' => 'Bottom Type']);
        $toddBoys->attributes()->create(['name' => 'Category']);
        $toddBoys->attributes()->create(['name' => 'Pattern Type']);
        $toddBoys->attributes()->create(['name' => 'Size']);
        $toddBoys->attributes()->create(['name' => 'Style']);
        $toddBoys->attributes()->create(['name' => 'Top Type']);
        $toddBoys->attributes()->create(['name' => 'Color']);

        // TODDLER GIRLS
        $toddGirls->attributes()->create(['name' => 'Age']);
        $toddGirls->attributes()->create(['name' => 'Bottom Type']);
        $toddGirls->attributes()->create(['name' => 'Category']);
        $toddGirls->attributes()->create(['name' => 'Pattern Type']);
        $toddGirls->attributes()->create(['name' => 'Size']);
        $toddGirls->attributes()->create(['name' => 'Style']);
        $toddGirls->attributes()->create(['name' => 'Top Type']);
        $toddGirls->attributes()->create(['name' => 'Color']);

        // BOYS
        $boys->attributes()->create(['name' => 'Age']);
        $boys->attributes()->create(['name' => 'Bottom Type']);
        $boys->attributes()->create(['name' => 'Category']);
        $boys->attributes()->create(['name' => 'Pattern Type']);
        $boys->attributes()->create(['name' => 'Size']);
        $boys->attributes()->create(['name' => 'Style']);
        $boys->attributes()->create(['name' => 'Top Type']);
        $boys->attributes()->create(['name' => 'Color']);

        // GIRLS
        $girls->attributes()->create(['name' => 'Age']);
        $girls->attributes()->create(['name' => 'Bottom Type']);
        $girls->attributes()->create(['name' => 'Category']);
        $girls->attributes()->create(['name' => 'Pattern Type']);
        $girls->attributes()->create(['name' => 'Size']);
        $girls->attributes()->create(['name' => 'Style']);
        $girls->attributes()->create(['name' => 'Top Type']);
        $girls->attributes()->create(['name' => 'Color']);

        // BAGS
        $bags->attributes()->create(['name' => 'Bag Size']);
        $bags->attributes()->create(['name' => 'Category']);
        $bags->attributes()->create(['name' => 'Color']);

        // KIDS ACCESSORIES & JEWELRY
        $kidsAccs->attributes()->create(['name' => 'Category']);
        $kidsAccs->attributes()->create(['name' => 'Details']);
        $kidsAccs->attributes()->create(['name' => 'Material']);
        $kidsAccs->attributes()->create(['name' => 'Pattern Type']);
        $kidsAccs->attributes()->create(['name' => 'Size']);
        $kidsAccs->attributes()->create(['name' => 'Style']);
        $kidsAccs->attributes()->create(['name' => 'Type']);
        $kidsAccs->attributes()->create(['name' => 'Color']);

        // KIDS SHOES
        $kidsShoe->attributes()->create(['name' => 'Category']);
        $kidsShoe->attributes()->create(['name' => 'Details']);
        $kidsShoe->attributes()->create(['name' => 'Material']);
        $kidsShoe->attributes()->create(['name' => 'Pattern Type']);
        $kidsShoe->attributes()->create(['name' => 'Size']);
        $kidsShoe->attributes()->create(['name' => 'Style']);
        $kidsShoe->attributes()->create(['name' => 'Type']);
        $kidsShoe->attributes()->create(['name' => 'Color']);

        // MATERNITY
        $maternity->attributes()->create(['name' => 'Category']);
        $maternity->attributes()->create(['name' => 'Details']);
        $maternity->attributes()->create(['name' => 'Length']);
        $maternity->attributes()->create(['name' => 'Material']);
        $maternity->attributes()->create(['name' => 'Neckline']);
        $maternity->attributes()->create(['name' => 'Pattern Type']);
        $maternity->attributes()->create(['name' => 'Size']);
        $maternity->attributes()->create(['name' => 'Sleeve Length']);
        $maternity->attributes()->create(['name' => 'Type']);
        $maternity->attributes()->create(['name' => 'Color']);

        // MOMMY & ME
        $mommy->attributes()->create(['name' => 'Category']);
        $mommy->attributes()->create(['name' => 'Details']);
        $mommy->attributes()->create(['name' => 'Length']);
        $mommy->attributes()->create(['name' => 'Material']);
        $mommy->attributes()->create(['name' => 'Neckline']);
        $mommy->attributes()->create(['name' => 'Pattern Type']);
        $mommy->attributes()->create(['name' => 'Size']);
        $mommy->attributes()->create(['name' => 'Sleeve Length']);
        $mommy->attributes()->create(['name' => 'Style']);
        $mommy->attributes()->create(['name' => 'Type']);
        $mommy->attributes()->create(['name' => 'Color']);
    }
}
