<?php

    use Illuminate\Database\Seeder;

    class TypesTableSeeder extends Seeder
    {

        public function run()
        {

            // users

            DB::table( 'boards_type' )->delete();

            $types = [ [ 'name' => 'Retrospektiva' ],
                       [ 'name' => 'Poker Planning' ],
                       [ 'name' => 'Brainstorming' ],
                       [ 'name' => 'Daily Standup' ] ];

            DB::table( 'boards_type' )->insert( $types );


        }

    }
