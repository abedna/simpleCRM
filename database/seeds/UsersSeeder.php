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

        if(count(DB::table('users')->get())==0) {
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
         if(!DB::table('users')->where('name', 'user')->first()){
             DB::table('users')->Insert(
                 [
                     'name'=>'user',
                     'email'=>'user@user.com',
                     'password'=>bcrypt('password'),
                     'created_at'=>now(),
                     'updated_at'=>now()
                 ]
             );
         }
    }

}
