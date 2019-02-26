<?php

use Illuminate\Database\Seeder;

class UsersProductsSizesCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 5)->create()->each(function($u) {
            $u->products()
            ->saveMany(
                factory(App\Product::class, rand(5,15))->make())
            ->each(function($c) {
                $c->category()
            ->create(factory(App\Category::class,4)->make())
            ->each(function($s) {
                $s->size()
            ->sync(factory(App\Size::class,4)->make());
                
                });
            });
        });
    }
}
