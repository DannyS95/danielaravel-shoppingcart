<?php

use Illuminate\Database\Seeder;
use \App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product([
            'imagePath' => 'https://cdn.waterstones.com/bookjackets/large/9780/5750/9780575094161.jpg',
            'title' => 'I Am Legend',
            'description' => 'sounds like a realy fun book',
            'price' => 10
        ]);
        $product->save();

        $product = new Product([
            'imagePath' => 'https://pre00.deviantart.net/3c65/th/pre/i/2011/133/f/1/dune_book_cover_by_closerinternal-d3g9lzj.jpg',
            'title' => 'Dune',
            'description' => 'Pewds book recommendation',
            'price' => 10
        ]);
        $product->save();

        $product = new Product([
            'imagePath' => 'https://images-na.ssl-images-amazon.com/images/I/413jwl4YU-L._SX337_BO1,204,203,200_.jpg',
            'title' => 'Life 3.0',
            'description' => 'Life 3.0: Being Human in the Age of Artificial Intelligence ',
            'price' => 10
        ]);
        $product->save();

        $product = new Product([
            'imagePath' => 'https://78.media.tumblr.com/b09873ebd66619b5a646c921af840bc9/tumblr_ngkqtfhdxm1t5e3l3o1_500.jpg',
            'title' => 'Beyond Good and Evil',
            'description' => 'very complex book, makes you think harder about things',
            'price' => 10
        ]);
        $product->save();

        $product = new Product([
            'imagePath' => 'https://images-na.ssl-images-amazon.com/images/I/41s4xJZlEYL.jpg',
            'title' => 'Man\'s Search for Meaning',
            'description' => 'Never tried this book but sounds interesting enough to',
            'price' => 10
        ]);
        $product->save();
    }
}
