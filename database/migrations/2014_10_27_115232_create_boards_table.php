<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreateBoardsTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            // Creates the roles table
            Schema::create( 'boards_type', function ( $table )
            {
                $table->increments( 'id' )->unsigned();
                $table->string( 'name' );
            } );

            // Creates the roles table
            Schema::create( 'boards', function ( $table )
            {
                $table->increments( 'id' )->unsigned();
                $table->integer( 'type_id' )->unsigned();
                $table->integer( 'author_id' )->unsigned();
                $table->string( 'name' );
                $table->string( 'slug' )->unique();
                $table->timestamps();

                $table->foreign( 'type_id' )->references( 'id' )->on( 'boards_type' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
                $table->foreign( 'author_id' )->references( 'id' )->on( 'users' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            } );
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table( 'boards', function ( Blueprint $table )
            {
                $table->dropForeign( 'boards_type_id_foreign' );
                $table->dropForeign( 'boards_author_id_foreign' );
            } );

            Schema::drop( 'boards_type' );
            Schema::drop( 'boards' );

        }

    }
