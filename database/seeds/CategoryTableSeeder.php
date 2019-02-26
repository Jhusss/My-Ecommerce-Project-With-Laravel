<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->delete();

        $c1 = App\Category::create([
            'title' =>  'Ankchoi',
            'url' => 'ankchoi'
        ]);

        $c2 = App\Category::create([
            'title' =>  'Betty',
            'url' => 'betty'
        ]);

        $c4 = App\Category::create([
            'title' =>  'Eliah',
            'url' => 'eliah'
        ]);

        $c3 = App\Category::create([
            'title' =>  'Jessica',
            'url' => 'jessica'
        ]);
        
    }
}
