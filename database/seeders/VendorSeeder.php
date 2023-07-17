<?php

namespace Database\Seeders;

use App\Models\Vendor;
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
            /***
                id bigInt [primary key]
                email varchar
                first_name varchar
                last_name varchar
                is_active tinyInteger
                phone varchar
             */
            $vendor->email = 'vendorEmail@gmail.com';
            $vendor->first_name = 'MR.';
            $vendor->last_name = 'Vendor';
            $vendor->is_active = '1';
            $vendor->phone = '+9701234567';
            
            $vendor->save();
        }
    }
}
