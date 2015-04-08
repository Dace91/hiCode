<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('categories')->delete();
        $dateTime = new DateTime('now');
        $dateTime = $dateTime->format('Y-m-d H:i:s');
        DB::table('categories')->insert(
            [
                [
                    'title' => 'PHP',
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime,
                ],
                [
                    'title' => 'MySQL',
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime,
                ],
                [
                    'title' => 'NoSQL',
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime,
                ]
            ]);

    }
}