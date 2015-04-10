<?php namespace App\Models;

use App\Support\Collection;
use App\Support\Repositories\Traits\Creatable;
use App\Support\Repositories\Traits\Deletable;
use App\Support\Repositories\Traits\Getable;
use App\Support\Repositories\Traits\Updatable;
use App\Support\Repository;

/**
 * Class UserRepository
 *
 * @package App\Http\Repositories
 */
class RoleRepository extends Repository
{
    /**
     * Create a user repository instance.
     *
     * @param Role $role
     *
     * @return void
     */
    function __construct( Role $role )
    {
        $this->model = $role;
    }


    /**
     * Add basic query
     *
     * @return $this
     */
    public function addBasicQuery()
    {
        $this->query = $this->getQuery()->with( 'users' )->orderBy( 'name', 'ASC' );

        return $this;
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
        $this->query = $this->getQuery()->where( 'name', 'like', '%'.$search );

        return $this;
    }

    /**
     * Fill data to model instance
     *
     * @param Role       $role
     * @param Collection $data
     *
     * @return mixed
     */
    public function fillData( Role $role, Collection $data )
    {
        $role->fill( $data->toArray() );

        $role->save();

        $role->users()->sync( $data->get( 'users', [ ] ) );

        return $role;
    }
}