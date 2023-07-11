<?php

namespace Database\Seeders;

use App\Models\d_user;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class d_userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo 'run seeder';


        // $users = d_user::factory()->count(5)->make();

        // foreach($users as $user){
        //     echo 'in seeding';
        //     $user->save();
        // }


        $d_users = d_user::factory(5)->create();
    }
}
