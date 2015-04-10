<?php

    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateProductsTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create( 'products', function ( Blueprint $table )
            {
                $table->increments( 'id' );
                $table->string( 'name' );
                $table->string( 'slug' );
                $table->text( 'perex' );
                $table->text( 'desc' );
                $table->text( 'keywords' );
                $table->string( 'image' )->nullable();
                $table->integer( 'price' )->unsigned();
                $table->integer( 'stock' )->unsigned();
                $table->integer( 'views' )->unsigned();

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
            Schema::drop( 'products' );
        }

    }
