<?php


    // ADMIN

    Breadcrumbs::register( 'admin', function ( $breadcrumbs )
    {
        $breadcrumbs->push( trans( 'common.Admin' ), route( 'admin' ) );
    } );

    Breadcrumbs::register( 'log', function ( $breadcrumbs )
    {
        $breadcrumbs->parent( 'admin' );
        $breadcrumbs->push( trans( 'common.Logs' ), route( 'admin.log.index' ) );
    } );


    // admin - USERS
    Breadcrumbs::register( 'users', function ( $breadcrumbs )
    {
        $breadcrumbs->parent( 'admin' );
        $breadcrumbs->push( trans( 'common.Users' ), route( 'admin.users.index' ) );
    } );

    Breadcrumbs::register( 'user', function ( $breadcrumbs, $user )
    {
        $breadcrumbs->parent( 'users' );
        if ( isset( $user ) )
        {
            $breadcrumbs->push( $user->name, route( 'admin.users.edit', [ $user->slug ] ) );
        }
        else
        {
            $breadcrumbs->push( trans( 'common.New user' ), route( 'admin.users.create' ) );
        }
    } );

    Breadcrumbs::register( 'roles', function ( $breadcrumbs )
    {
        $breadcrumbs->parent( 'admin' );
        $breadcrumbs->push( trans( 'common.Roles' ), route( 'admin.roles.index' ) );
    } );

    Breadcrumbs::register( 'role', function ( $breadcrumbs, $role )
    {
        $breadcrumbs->parent( 'roles' );
        if ( isset( $role ) )
        {
            $breadcrumbs->push( $role->name, route( 'admin.roles.edit', [ $role->slug ] ) );
        }
        else
        {
            $breadcrumbs->push( trans( 'common.New role' ), route( 'admin.roles.create' ) );
        }
    } );


    // admin - PRODUCTS

    Breadcrumbs::register( 'products', function ( $breadcrumbs )
    {
        $breadcrumbs->parent( 'admin' );
        $breadcrumbs->push( trans( 'common.Products' ), route( 'admin.products.index' ) );
    } );
    Breadcrumbs::register( 'product', function ( $breadcrumbs, $product )
    {
        $breadcrumbs->parent( 'products' );
        if ( isset( $product ) )
        {
            $breadcrumbs->push( $product->name, route( 'admin.products.edit', [ $product->slug ] ) );
        }
        else
        {
            $breadcrumbs->push( trans( 'common.New product' ), route( 'admin.products.create' ) );
        }
    } );


    // admin - CATEGORIES

    Breadcrumbs::register( 'categories', function ( $breadcrumbs )
    {
        $breadcrumbs->parent( 'admin' );
        $breadcrumbs->push( trans( 'common.Categories' ), route( 'admin.categories.index' ) );
    } );
    Breadcrumbs::register( 'category', function ( $breadcrumbs, $category )
    {
        $breadcrumbs->parent( 'categories' );
        if ( isset( $category ) )
        {
            $breadcrumbs->push( $category->name, route( 'admin.categories.edit', [ $category->slug ] ) );
        }
        else
        {
            $breadcrumbs->push( trans( 'common.New category' ), route( 'admin.categories.create' ) );
        }
    } );