<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users= [
            [
                'name' => 'admin',
                'username' => 'admin001',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'university_id' => 0,
                'registration_no' => 123123,
                'is_admin' => 1,
                'points' => 0
            ],
            [
                'name' => 'user',
                'username' => 'user001',
                'email' => 'user@gmail.com',
                'password' => bcrypt('123456'),
                'university_id' => 0,
                'registration_no' => 123123,
                'contact_no' => 123123,
                'is_admin' => 0,
                'points' => 0
            ],
            [
                'name' => 'user2',
                'username' => 'user002',
                'email' => 'user2@gmail.com',
                'password' => bcrypt('123456'),
                'university_id' => 0,
                'registration_no' => 123123,
                'contact_no' => 123123,
                'is_admin' => 0,
                'points' => 0
            ]
        ];

        foreach($users as $user){
            DB::table('users')->insert($user);
        }
        //
        // DB::table('users')->insert(
        //     [
        //         'name' => 'admin',
        //         'username' => 'admin001',
        //         'email' => 'admin@gmail.com',
        //         'password' => bcrypt('123456'),
        //         'university' => 'SUST',
        //         'registration_no' => 123123,
        //         'is_admin' => 1,
        //         'points' => 0
        //     ],
        //     [
        //         'name' => 'user',
        //         'username' => 'user001',
        //         'email' => 'user@gmail.com',
        //         'password' => bcrypt('123456'),
        //         'university' => 'SUST',
        //         'registration_no' => 123123,
        //         'contact_no' => 123123,
        //         'is_admin' => 0,
        //         'points' => 0
        //     ]
        // );
    }
}
