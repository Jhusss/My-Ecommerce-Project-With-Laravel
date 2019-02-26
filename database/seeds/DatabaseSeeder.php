<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \DB::table('products')->delete();

        $this->call([
            // UsersTableSeeder::class,
            SizeTableSeeder::class,
            // RoleTableSeeder::class,
            // CategoryTableSeeder::class,

            // UsersProductsSizesCategoriesTableSeeder::class
        ]);
        
        
        // factory(App\User::class, 6)->create()->each(function($u) {
        //     $u->products()
        //     ->saveMany(
        //         factory(App\Product::class, rand(5,10))->make()
        //     );
        // });

        
    }
}
