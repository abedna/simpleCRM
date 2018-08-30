<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        $faker=Faker::create('App\Company');

        for($i=0; $i<5; $i++){

            DB::table('companies')->Insert(
                [
                    'Name' => $faker->company(),
                    'email' => $faker->companyEmail(),
                    'website' => $faker->domainName(),
                    'logo' => $faker->image('public/upload'),
                    'description'=>$faker->randomHtml()
                ]
            );
        }

    }
}
