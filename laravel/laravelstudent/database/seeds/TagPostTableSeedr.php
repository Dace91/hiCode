<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TagPostTableSeeder extends Seeder
{

    public function run()
    {
        $dateTime = new DateTime('now');
        $dateTime = $dateTime->format('Y-m-d H:i:s');
        DB::table('tag_post')->insert(
            [
                [
                    'tag_id' =>1,
                    'post_id'=>1
                ],
                [
                    'tag_id' =>2,
                    'post_id'=>1
                ],
                [
                    'tag_id' =>2,
                    'post_id'=>2
                ],
                [
                    'tag_id' =>2,
                    'post_id'=>3
                ]
            ]);
    }

}
