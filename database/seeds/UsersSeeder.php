<?php

use Illuminate\Database\Seeder;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


            DB::table('users')->Insert(
                [
                    'name'=>'admin',
                    'email'=>'admin@admin.com',
                    'password'=>bcrypt('password'),
                    'created_at'=>now(),
                    'updated_at'=>now()
                ]
            );

    }
}
