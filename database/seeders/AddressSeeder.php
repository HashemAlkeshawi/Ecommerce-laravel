<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            
            /***
             addressable_id bigInt
             addressable_type varchar
             city_id bigInt
             district varchar
             street varchar
             phone varchar
             */
            $address = new Address();

            $address->addressable_id = '4';
            $address->addressable_type = 'vendor';
            $address->city_id = 1;
            $address->district = 'somewhare';
            $address->street = 'STR-2-there';
            $address->phone = '+9701234567';
            
            $address->save();
        }
    }
}
