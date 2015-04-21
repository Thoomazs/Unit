<?php


    /**
     * Return controller name
     *
     * @return string
     */
    function controller()
    {
        $controller = explode( '\\', substr( Route::currentRouteAction(), 0, ( strpos( Route::currentRouteAction(), '@' ) - 0 ) ) );
        $controller = $controller[ count( $controller ) - 1 ];

        return substr( $controller, 0, ( strpos( $controller, 'Controller' ) - 0 ) );
    }


    /**
     * Create array ( "id" => "name" ) from models Collection
     *
     * @param \Illuminate\Database\Eloquent\Collection $model
     *
     * @return array
     */
    function toChoices( Illuminate\Database\Eloquent\Collection $model )
    {
        $result = [ ];

        foreach ( $model as $v ) $result[ $v->id ] = $v->name;

        return $result;
    }


    function datetime( $date, $time = '00:00:00' )
    {
        return date( 'Y-m-d H:i:s', strtotime( $date." ".$time ) );
    }

    /**
     * Slugify text
     *
     * @param      $text
     * @param bool $strict
     *
     * @return bool|mixed|string
     */
    function slugify( $text, $strict = true )
    {
        $text = html_entity_decode( $text, ENT_QUOTES, 'UTF-8' );
        // replace non letter or digits by -
        $text = preg_replace( '~[^\\pL\d.]+~u', '-', $text );

        // trim
        $text = trim( $text, '-' );
        setlocale( LC_CTYPE, 'en_GB.utf8' );
        // transliterate
        if ( function_exists( 'iconv' ) )
        {
            $text = iconv( 'utf-8', 'us-ascii//TRANSLIT', $text );
        }

        // lowercase
        $text = strtolower( $text );
        // remove unwanted characters
        $text = preg_replace( '~[^-\w.]+~', '', $text );
        if ( empty( $text ) )
        {
            return 'empty_$';
        }
        if ( $strict )
        {
            $text = str_replace( ".", "_", $text );
        }

        return $text;
    }

    function export( array $data )
    {
        return var_export( $data, true );
    }