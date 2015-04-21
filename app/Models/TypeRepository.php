<?php namespace App\Models;

use App\Support\Collection;
use App\Support\Repositories\Traits\Slugable;
use App\Support\Repository;

/**
 * Class TypeRepository
 *
 * @package App\Http\Repositories
 */
class TypeRepository extends Repository
{
    use Slugable;

    /**
     * Create a type repository instance.
     *
     * @param Type $type
     *
     * @return void
     */
    function __construct( Type $type )
    {
        $this->model = $type;
    }

    /**
     * Add basic query
     *
     * @return $this
     */
    public function addBasicQuery()
    {
        return $this->getQuery()->orderBy( 'name', 'ASC' );
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
     * @param Type       $role
     * @param Collection $data
     *
     * @return mixed
     */
    public function fillData( Type $type, Collection $data )
    {
        $type->fill( $data->toArray() );

        $type->save();

        return $type;
    }
}