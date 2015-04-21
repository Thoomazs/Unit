<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardsUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('boards_users', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('like')->unsigned();
			$table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('boards_users', function (Blueprint $table) {
            $table->dropForeign('boards_user_id_foreign');
        });

        Schema::drop('boards_users');
	}

}
