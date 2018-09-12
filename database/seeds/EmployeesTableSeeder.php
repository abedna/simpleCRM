<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Modules\Companies\Models\Company;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Modules\Companies\Models\Employee');

        $comp = Company::all();
        foreach ($comp as $key => $value) {
            $arr[] = $value->getAttribute('id');
        }

        for ($i = 0; $i < 100; $i++) {
            DB::table('employees')->Insert(
                [
                    'firstName' => $faker->firstName(),
                    'lastName' => $faker->lastName(),
                    'email' => $faker->email(),
                    'phone' => $faker->phoneNumber(),
                    'department' => $faker->randomElement(['biuro', 'zarząd', 'teren']),
                    'birthDate' => $faker->date(),
                    'salary' => $faker->numberBetween(2000, 10000),
                    'company' => $faker->randomElement($arr)
                ]
            );
        }
      }

}
