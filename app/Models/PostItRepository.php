<?php namespace App\Models;

use App\Support\Collection;
use App\Support\Repositories\Traits\Slugable;
use App\Support\Repository;

/**
 * Class PostItRepository
 *
 * @package App\Http\Repositories
 */
class PostItRepository extends Repository
{
    /**
     * Create a PostIt repository instance.
     *
     * @param PostIt $PostIt
     *
     * @return void
     */
    function __construct( PostIt $PostIt )
    {
        $this->model = $PostIt;
    }

    /**
     * Add basic query
     *
     * @return $this
     */
    public function addBasicQuery()
    {
        return $this->getQuery()->with( 'author' )->with( 'board' )->orderBy( 'id', 'DESC' );
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
        $this->query = $this->getQuery()->where( 'text', 'like', '%'.$search );

        return $this;
    }

    public function board( $id )
    {
        $this->query = $this->getQuery()->where( 'board_id', '=', $id );

        return $this;
    }

    /**
     * Fill data to model instance
     *
     * @param PostIt      $role
     * @param Collection $data
     *
     * @return mixed
     */
    public function fillData( PostIt $PostIt, Collection $data )
    {
        $PostIt->fill( $data->toArray() );

        $PostIt->save();

        return $PostIt;
    }
}