<?php

namespace Database\Seeders;

use App\Models\user;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo 'run seeder';


        // $users = user::factory()->count(5)->make();

        // foreach($users as $user){
        //     echo 'in seeding';
        //     $user->save();
        // }


        $users = User::factory(5)->create();
    }
}
