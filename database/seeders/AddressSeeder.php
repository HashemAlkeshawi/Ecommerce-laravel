<?php

namespace Database\Seeders;

use App\Models\Address\Address;
use App\Models\Dashboard\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { {

            /***
             addressable_id bigInt
             addressable_type varchar
             city_id bigInt
             district varchar
             street varchar
             phone varchar
             */
            $address = new Address();

            $address->city_id = 1;
            $address->district = 'somewhare';
            $address->street = 'STR-2-there';
            $address->phone = '+9701234567';

            $vendor = Vendor::find(13);
            $vendor->address()->save($address);

            // $user = d_user::find(7);
            // $user->address()->save($address);
        }
    }
}
