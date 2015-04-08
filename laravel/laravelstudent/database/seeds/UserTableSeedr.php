<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        $dateTime = new DateTime('now');
        $dateTime = $dateTime->format('Y-m-d H:i:s');
        DB::table('users')->insert(
            [
                [
                    'name'       => 'Antoine',
                    'email'      => 'antoine.lucsko@wanadoo.fr',
                    'password'   => Hash::make('Antoine'),
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime,
                ],
                [
                    'name'       => 'Cecile',
                    'email'      => 'cecile.lucsko@wanadoo.fr',
                    'password'   => Hash::make('Cecile'),
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime,
                ]
            ]);
    }

}
