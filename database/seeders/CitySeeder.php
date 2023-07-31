<?php

namespace Database\Seeders;

use App\Models\Address\City;
use App\Models\Address\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { {
            $city = new City();
            $city->name = fake()->city();

            $countries = Country::get()->toArray();
            $city->country_id =   $countries[rand(0, count($countries) - 1)]['id'];

            $city->save();
        }
    }
}
