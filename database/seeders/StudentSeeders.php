<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class StudentSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('students')->truncate();
        $rows=[
          [
            'sname'=> 'dtfdft',
            'semail'=> 'gfggf08@gmail.com',
            'smobile'=> '0123456789',
            'sgender'=> 'm',
            'status' => false,
            'profile_picture'=>'1688713210.png',
          ],
          [
            'sname'=> 'Sankalpa Maharajan',
            'semail'=> 'sanku08@gmail.com',
            'smobile'=> '0123146789',
            'sgender'=> 'f',
            'status' => true,
            'profile_picture'=>'1688713210.png',
          ]
        ];
        DB::table('students')->insert($rows);
    }
}
