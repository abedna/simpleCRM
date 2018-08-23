<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Company;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create('App\Employee');

        $comp= Company::all();
        foreach($comp as $key=>$value){
            $arr[]= $value->getAttribute('id');
        }

        for($i = 1; $i <= 10; $i++) {
            DB::table('employees')->Insert(
                [
                    'firstName' => $faker->firstName(),
                    'lastName' => $faker->lastName(),
                    'email' => $faker->email(),
                    'phone' => $faker->phoneNumber(),
                    'company' => $faker->randomElement($arr)
                ]
            );
        }
    }
}
