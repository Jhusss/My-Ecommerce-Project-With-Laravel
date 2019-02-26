<?php

use Illuminate\Database\Seeder;

use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('users')->delete();
        
        App\User::create([
            'name' => 'Justin Fidelis',
            'role_id' => 1,
            'email' => 'justinoneil.fidelis0817@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123')

        ]);
        
    }
}
