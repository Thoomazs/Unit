<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreateUsersTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create( 'users', function ( Blueprint $table )
            {
                $table->increments( 'id' )->unsigned();

                $table->string( 'email' )->nullable()->unique();

                $table->string( 'firstname' );
                $table->string( 'lastname' );
                $table->string( 'slug' )->unique();
                $table->string( 'password', 60 )->nullable();

                $table->rememberToken();
                $table->timestamps();

            } );
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::drop( 'users' );
        }

    }
