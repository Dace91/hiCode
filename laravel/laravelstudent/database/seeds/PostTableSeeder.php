<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('posts')->delete();
        $dateTime = new DateTime('now');
        $dateTime = $dateTime->format('Y-m-d H:i:s');
        DB::table('posts')->insert(
            [
                [
                    'title'       => 'php tour',
                    'category_id' => 1,
                    'user_id'     => 1,
                    'content'     => 'Erat autem diritatis eius hoc quoque indicium nec obscurum nec latens, quod ludicris cruentis delectabatur et in circo sex vel septem aliquotiens vetitis certaminibus pugilum vicissim se concidentium perfusorumque sanguine specie ut lucratus ingentia laetabatur.',
                    'created_at'  => $dateTime,
                    'updated_at'  => $dateTime,
                ],
                [
                    'title'       => 'php tour2',
                    'category_id' => 1,
                    'user_id'     => 2,
                    'content'     => 'Erat autem diritatis eius hoc quoque indicium nec obscurum nec latens, quod ludicris cruentis delectabatur et in circo sex vel septem aliquotiens vetitis certaminibus pugilum vicissim se concidentium perfusorumque sanguine specie ut lucratus ingentia laetabatur.',
                    'created_at'  => $dateTime,
                    'updated_at'  => $dateTime,
                ],
                [
                    'title'       => 'NoSQL Redis',
                    'category_id' => 3,
                    'user_id'     => 1,
                    'content'     => 'Erat autem diritatis eius hoc quoque indicium nec obscurum nec latens, quod ludicris cruentis delectabatur et in circo sex vel septem aliquotiens vetitis certaminibus pugilum vicissim se concidentium perfusorumque sanguine specie ut lucratus ingentia laetabatur',
                    'created_at'  => $dateTime,
                    'updated_at'  => $dateTime,
                ],
                [
                    'title'       => 'Ocaml',
                    'category_id' => null,
                    'user_id'     => 2,
                    'content'     => 'Erat autem diritatis eius hoc quoque indicium nec obscurum nec latens, quod ludicris cruentis delectabatur et in circo sex vel septem aliquotiens vetitis certaminibus pugilum vicissim se concidentium perfusorumque sanguine specie ut lucratus ingentia laetabatur',
                    'created_at'  => $dateTime,
                    'updated_at'  => $dateTime,
                ],
            ]
        );
    }

}
