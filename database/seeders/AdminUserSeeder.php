<?php

namespace Database\Seeders;

use App\Models\d_user;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $d_user = new d_user();
        $d_user->username = 'adminUserName';
        $d_user->email = 'adminEmail@email.com';
        $d_user->password = Hash::make('adminADMIN@123');
        $d_user->first_name = 'Admin';
        $d_user->last_name = '_admin';
        $d_user->is_active = 1;
        $d_user->is_admin = 1;

        $d_user->save();
    }
}
