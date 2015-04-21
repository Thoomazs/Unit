<?php

    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */


    Route::group( [ 'namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => [ 'admin' ] ], function ()
    {
        Route::bind( "users", function ( $id )
        {
            return App\Models\User::find( $id );
        } );

        Route::bind( "roles", function ( $id )
        {
            return App\Models\Role::find( $id );
        } );


        Route::resource( 'users', 'UserController' );

        Route::resource( 'roles', 'RoleController' );

        Route::resource( 'log', 'LogController' );

        Route::get( '/', [ 'as' => 'admin', 'uses' => 'HomeController@getHomepage' ] );
    } );

    /*
    |--------------------------------------------------------------------------
    | Authentication & Password Reset Controllers
    |--------------------------------------------------------------------------
    |
    | These two controllers handle the authentication of the users of your
    | application, as well as the functions necessary for resetting the
    | passwords for your users. You may modify or remove these files.
    |
    */

    Route::group( [ 'middleware' => [ 'guest' ], 'namespace' => 'Auth' ], function ()
    {
        // Login & Register

        Route::get( 'register', [ 'as' => 'auth.register', 'uses' => 'AuthController@getRegister' ] );

        Route::post( 'register', 'AuthController@postRegister' );

        Route::get( 'login', [ 'as' => 'auth.login', 'uses' => 'AuthController@getLogin' ] );

        Route::post( 'login', 'AuthController@postLogin' );

        // Password Reminders

        Route::get( 'forget-password', [ 'as' => 'password.email', 'uses' => 'PasswordController@getEmail' ] );

        Route::post( 'forget-password', [ 'uses' => 'PasswordController@postEmail' ] );

        Route::get( 'reset-password/{token}  ', [ 'as' => 'password.reset.token', 'uses' => 'PasswordController@getReset' ] );

        Route::post( 'reset-password', [ 'as' => 'password.reset', 'uses' => 'PasswordController@postReset' ] );

    } );

    Route::group( [ 'middleware' => [ 'auth' ] ], function ()
    {
        // Logout
        Route::get( 'logout', [ 'as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout' ] );

        // User profile
        Route::get( 'profile', [ 'as' => 'my-account.profile', 'uses' => 'User\MyAccountController@getProfile' ] );

        Route::patch( 'profile', 'User\MyAccountController@postProfile' );

    } );

    /*
    |--------------------------------------------------------------------------
    | Poker Planning site Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::group( [ 'namespace' => 'PokerPlanning',  'prefix' => 'poker', ], function ()
    {
        Route::get( '/', [ 'as' => 'poker-planing.index', 'uses' => 'HomeController@index' ] );
    } );


    /*
    |--------------------------------------------------------------------------
    | Retrospective site Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::group( [ 'namespace' => 'Retrospective',  'prefix' => 'poker', ], function ()
    {
        Route::get( '/', [ 'as' => 'retrospective.index', 'uses' => 'HomeController@index' ] );
    } );

    /*
   |--------------------------------------------------------------------------
   | Static site Routes
   |--------------------------------------------------------------------------
   |
   */

    Route::get( '/', [ 'as' => 'home', 'uses' => 'HomeController@index' ] );