<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePokerPlanning extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'poker_planning', function ( Blueprint $table )
        {
            $table->increments( 'id' )->unsigned();

            $table->integer( 'idUser' )->unsigned();
            $table->integer( 'idStory' )->unsigned();

            $table->foreign( 'idUser' )->references( 'id' )->on( 'users' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreign( 'idStory' )->references( 'id' )->on( 'boards' )->onUpdate( 'cascade' )->onDelete( 'cascade' );

            $table->integer( 'value' );
            $table->boolean( 'ready' );

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
        Schema::drop( 'poker_planning' );
    }

}
