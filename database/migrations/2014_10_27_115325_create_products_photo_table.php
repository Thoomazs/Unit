<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsPhotoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('products_photo', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->string('path')->unique();
            $table->timestamps();

            $table->foreign( 'product_id' )->references( 'id' )->on( 'products' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
        });

    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table( 'products_photo', function ( Blueprint $table )
        {
            $table->dropForeign( 'products_photo_product_id_foreign' );
        } );

		Schema::drop('products_photo');
	}

}
