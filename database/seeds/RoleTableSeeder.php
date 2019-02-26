<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('roles')->delete();
        
        App\Role::create([
            'name' => 'administrator'
        ]);

        App\Role::create([
            'name' => 'staff'
        ]);
    }
}
