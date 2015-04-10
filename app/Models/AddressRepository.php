<?php namespace App\Models;

use App\Models\Address;
use App\Support\Repositories\Traits\Creatable;
use App\Support\Repository;
use Illuminate\Contracts\Auth\Guard as Auth;
use App\Support\Collection;

/**
 * Class AuthRepository
 *
 * @package App\Http\Repositories
 */
class AddressRepository extends Repository
{
    /**
     * Create a user repository instance.
     *
     * @param Auth $auth
     *
     * @return void
     */
    function __construct( Address $address )
    {
        $this->model =  $address;
    }



    /**
     * Search different columns by given atrribute
     *
     * @param $search
     *
     * @return $this
     */
    public function search( $search )
    {
        return $this;
    }

    public function getAddressId( Collection $data, $prefix = "" )
    {
        $address = $this->getAddress( $data, $prefix );

        if ( is_null( $address ) ) return null;

        return $address->id;
    }

    public function getAddress( Collection $data, $prefix = "" )
    {
        if ( $this->hasEmptyAddress( $data, $prefix ) ) return null;

        $address_data = Collection::make( [ 'street'   => $data->get( $prefix.'street' ),
                                            'city'     => $data->get( $prefix.'city' ),
                                            'postcode' => $data->get( $prefix.'postcode' ),
                                            'state'    => $data->get( $prefix.'state' ) ] );

        $address = $this->findAddress( $address_data );



        return ( is_null( $address ) ) ? $this->create( $address_data->toArray() ) : $address;
    }

    protected function hasEmptyAddress( Collection $data, $prefix = "" )
    {
        return $data->isEmpty( $prefix.'street' ) and $data->isEmpty( $prefix.'city' ) and $data->isEmpty( $prefix.'postcode' ) and $data->isEmpty( $prefix.'state' );
    }


    public function findAddress( Collection $data )
    {
        $address = $this->model;

        if ( ! $data->isEmpty( 'street' ) ) $address = $address->whereStreet( $data->street );
        if ( ! $data->isEmpty( 'city' ) ) $address = $address->whereCity( $data->city );
        if ( ! $data->isEmpty( 'postcode' ) ) $address = $address->wherePostcode( $data->postcode );
        if ( ! $data->isEmpty( 'state' ) ) $address = $address->whereState( $data->state );

        return $address->first();
    }


}