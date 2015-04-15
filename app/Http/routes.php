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

        Route::bind( "products", function ( $id )
        {
            return App\Models\Product::find( $id );
        } );

        Route::bind( "categories", function ( $id )
        {
            return App\Models\Category::find( $id );
        } );

        Route::resource( 'users', 'UserController' );

        Route::resource( 'roles', 'RoleController' );

        Route::resource( 'products', 'ProductController' );

        Route::resource( 'categories', 'CategoryController' );

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
    | Shop site Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::group( [ 'namespace' => 'Shop' ], function ()
    {
        Route::bind( "product", function ( $slug )
        {
            return App\Models\Product::whereSlug( $slug )->first();
        } );

        Route::get( 'products', [ 'as' => 'products.index', 'uses' => 'ProductController@getIndex' ] );
        Route::get( 'product/{product}', [ 'as' => 'products.detail', 'uses' => 'ProductController@getDetail' ] );
        Route::post( 'product/{product}/send', [ 'as' => 'products.send', 'uses' => 'ProductController@postQuery' ] );


        // Cart
        Route::get( 'shopping-cart', [ 'as' => 'cart.show', 'uses' => 'CartController@getCart' ] );
        Route::post( 'shopping-cart/add', [ 'as' => 'cart.add', 'uses' => 'CartController@postAdd' ] );
        Route::delete( 'shopping-cart/delete', [ 'as' => 'cart.delete', 'uses' => 'CartController@postDelete' ] );
        Route::patch( 'shopping-cart/update', [ 'as' => 'cart.update', 'uses' => 'CartController@postUpdate' ] );

        Route::get( 'shopping-cart/delivery-information', [ 'as' => 'cart.delivery-information', 'uses' => 'CartController@getDeliveryInformation' ] );
        Route::post( 'shopping-cart/delivery-information', 'CartController@postDeliveryInformation' );

        Route::get( 'shopping-cart/shipping-and-payment', [ 'as' => 'cart.shipping-and-payment', 'uses' => 'CartController@getShippingAndPayment' ] );
        Route::post( 'shopping-cart/shipping-and-payment', 'CartController@postShippingAndPayment' );

        Route::get( 'shopping-cart/summary', [ 'as' => 'cart.summary', 'uses' => 'CartController@getSummary' ] );
        Route::post( 'shopping-cart/summary', 'CartController@postSummary' );

        Route::get( 'shopping-cart/thank-you', [ 'as' => 'cart.thank-you', 'uses' => 'CartController@getThankYou' ] );
    } );


    /*
   |--------------------------------------------------------------------------
   | Static site Routes
   |--------------------------------------------------------------------------
   |
   */

    Route::get( '/', [ 'as' => 'home', 'uses' => 'HomeController@index' ] );

    // JUST TESTing things
    Route::get( '/nonExistingPage', 'Error404Controller@fakeMethod');