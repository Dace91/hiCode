<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TagTableSeeder extends Seeder
{

    public function run()
    {
        $dateTime = new DateTime('now');
        $dateTime = $dateTime->format('Y-m-d H:i:s');
        DB::table('tags')->insert(
            [
                [
                    'name'       => 'programming',
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime,
                ],
                [
                    'name'       => 'development',
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime,
                ]
            ]);
    }

}
