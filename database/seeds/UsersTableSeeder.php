<?php

    use Illuminate\Database\Seeder;

    class UsersTableSeeder extends Seeder
    {

        public function run()
        {

            // users

            DB::table( 'users' )->delete();

            $users = [ [ 'firstname'  => 'Tomáš',
                         'lastname'   => 'Novotný',
                         'slug'       => 'tomas-novotny',
                         'email'      => 'novott20@fit.cvut.cz',
                         'password'   => bcrypt( 'heslo' ),
                         'created_at' => new DateTime,
                         'updated_at' => new DateTime ],

                        [ 'firstname'  => 'Martin',
                         'lastname'   => 'Tauchman',
                         'slug'       => 'martin-tauchman',
                         'email'      => 'mtauchman@gmail.com',
                         'password'   => bcrypt( 'hesloHeslo' ),
                         'created_at' => new DateTime,
                         'updated_at' => new DateTime ]
                        ];

            DB::table( 'users' )->insert( $users );


        }

    }
