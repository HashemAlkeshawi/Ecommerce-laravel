<?php

namespace Database\Seeders;

use App\Models\Dashboard\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        {
            $vendor = new Vendor();
      
            $vendor->email = 'hashemalkeshawi@gmail.com';
            $vendor->first_name = 'MR.';
            $vendor->last_name = 'Vendor';
            $vendor->is_active = '1';
            $vendor->phone = '+9701234567';
            
            $vendor->save();
        }
    }
}
