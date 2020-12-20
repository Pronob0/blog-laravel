<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert([
           'role_id'=>'1',
           'name'=>'Admin',
           'user_name'=>'pronob',
           'email'=>'pronob@mail.com',
           'password'=>bcrypt('pronob0098'),
           
       ]);
       DB::table('users')->insert([
       'role_id'=>'2',
       'name'=>'Author',
       'user_name'=>'Mamun',
       'email'=>'Mamun@mail.com',
       'password'=>bcrypt('pronob0098'),

       ]);
    }
}
