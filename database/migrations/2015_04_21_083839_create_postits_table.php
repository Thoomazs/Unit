<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('postits', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('board_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('type', 10);
            $table->string('text', 100);
            $table->integer('like')->unsigned();
            $table->tinyInteger('visible')->unsigned()->default(0);
			$table->timestamps();

            $table->foreign('board_id')->references('id')->on('boards')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('postits', function (Blueprint $table) {
            $table->dropForeign('postits_user_id_foreign');
            $table->dropForeign('postits_board_id_foreign');
        });

        Schema::drop('postits');
	}

}
