<?php namespace App\Support;

use Illuminate\Support\Collection as BaseCollection;

class Collection extends BaseCollection
{

    public function isEmpty( $key = null )
    {
        if ( is_null( $key ) ) return parent::isEmpty();

        $data = $this->get( $key );

        return empty( $data );
    }

    public function __get( $key )
    {
        return $this->get( $key );
    }

    public function __set( $key, $value )
    {
        $this->put( $key, $value );
    }

    public function __toArray()
    {
        return $this->toArray();
    }

}