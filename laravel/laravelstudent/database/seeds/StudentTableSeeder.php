<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StudentTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('students')->delete();
        $dateTime = new DateTime('now');
        $dateTime = $dateTime->format('Y-m-d H:i:s');
        DB::table('students')->insert(
            [
                [
                    'firstname'  => 'Tony',
                    'name'       => 'Tony',
                    'bio'        => 'blablablabla',
                    'type'       => 'dev',
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime,
                ],
                [
                    'firstname'  => 'Tony',
                    'name'       => 'Tony',
                    'bio'        => 'blablablabla',
                    'type'       => 'dev',
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime,
                ],
                [
                    'firstname'  => 'Tony',
                    'name'       => 'Tony',
                    'bio'        => 'blablablabla',
                    'type'       => 'dev',
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime,
                ],
            ]
        );
    }

}
