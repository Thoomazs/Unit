<?php namespace App\Models;

use App\Support\Collection;
use App\Support\Repositories\Traits\Slugable;
use App\Support\Repository;

/**
 * Class BoardRepository
 *
 * @package App\Http\Repositories
 */
class BoardRepository extends Repository
{
    use Slugable;

    /**
     * Create a board repository instance.
     *
     * @param Board $board
     *
     * @return void
     */
    function __construct( Board $board )
    {
        $this->model = $board;
    }

    /**
     * Add basic query
     *
     * @return $this
     */
    public function addBasicQuery()
    {
        return $this->getQuery()->with( 'type' )->with( 'users' )->orderBy( 'name', 'ASC' );
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
     * @return $this
     */
    public function retrospective()
    {
        $id = Type::whereName( 'Retrospektiva' )->first()->id;

        $this->query = $this->getQuery()->whereTypeId( $id );

        return $this;
    }

    /**
     * @return $this
     */
    public function poker()
    {
        $id = Type::whereName( 'Poker Planning' )->first()->id;

        $this->query = $this->getQuery()->whereTypeId( $id );

        return $this;
    }

    /**
     * @param $slug
     *
     * @return $this
     */
    public function slug( $slug )
    {
        $this->query = $this->getQuery()->whereSlug( $slug );

        return $this;
    }

    /**
     * Fill data to model instance
     *
     * @param Board      $role
     * @param Collection $data
     *
     * @return mixed
     */
    public function fillData( Board $board, Collection $data )
    {
        $data->slug = $this->createSlug( $data->name, $data->get( 'id', 0 ) );

        $board->fill( $data->toArray() );

        $board->save();

        return $board;
    }
}