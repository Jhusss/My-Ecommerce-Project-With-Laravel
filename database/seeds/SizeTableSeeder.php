<?php

use Illuminate\Database\Seeder;
use App\Size;
class SizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sizes')->delete();
        
        App\Size::create([
            'name'=>'Extra Small'
        ]);
        App\Size::create([
            'name'=>'Small'
        ]);

        App\Size::create([
            'name'=>'Medium'
        ]);

        App\Size::create([
            'name' =>'Large'
        ]);
    }
}
