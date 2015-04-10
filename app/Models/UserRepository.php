<?php namespace App\Models;

use App\Support\Collection;
use App\Support\Repositories\Traits\FileManager;
use App\Support\Repositories\Traits\Slugable;
use App\Support\Repository;
use Illuminate\Support\Facades\Cookie;

/**
 * Class UserRepository
 *
 * @package App\Http\Repositories
 */
class UserRepository extends Repository
{
    use Slugable, FileManager;

    /**
     * Create a user repository instance.
     *
     * @param User $user
     *
     * @return void
     */
    function __construct( User $user )
    {
        $this->model = $user;
    }

    /**
     * Add basic query
     *
     * @return $this
     */
    public function addBasicQuery()
    {
        return $this->getQuery()->with( 'roles' )->orderBy( 'lastname', 'ASC' )->orderBy( 'firstname', 'ASC' );
    }

    /**
     * Search
     *
     * @param $search
     *
     * @return $this
     */
    public function search( $search )
    {
        $this->query = $this->getQuery()->where( 'firstname', 'like', '%'.$search )->orWhere( 'lastname', 'like', '%'.$search )->orWhere( 'email', 'like', '%'.$search.'%' );

        return $this;
    }

    /**
     * Fill data to model instance
     *
     * @param User       $role
     * @param Collection $data
     *
     * @return mixed
     */
    public function fillData( User $user, Collection $data )
    {
        $data->slug = $this->createSlug( $data->firstname.' '.$data->lastname, $data->get( 'id', 0 ) );

        if ( $data->isEmpty( 'password' ) ) $data->forget( 'password' );

        //        $data->address_id = $this->addressRepo->getAddressId( $data );

        $user->fill( $data->toArray() );

        $user->save();

        if ( $data->has( 'roles' ) ) $user->roles()->sync( $data->get( 'roles', [ ] ) );

        return $user;
    }


    /**
     * Create new temp user for shopping-cart purposes
     *
     * @param $user
     *
     * @return User
     */
    public function createTemporaryUser()
    {
        $user = $this->getModel()->newInstance();

        $user->save();

        Cookie::queue( 'tempUser', $user->id, 2628000 );

        return $user;
    }
}