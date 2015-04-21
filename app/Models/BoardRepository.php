<?php namespace App\Models;

use App\Support\Collection;
use App\Support\Repositories\Traits\FileManager;
use App\Support\Repositories\Traits\Slugable;
use App\Support\Repository;
use Illuminate\Support\Facades\Cookie;

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
        return $this->getQuery()->with( 'type' )->orderBy( 'name', 'ASC' );
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
     * @param Board       $role
     * @param Collection $data
     *
     * @return mixed
     */
    public function fillData( Board $board, Collection $data )
    {
        $data->slug = $this->createSlug( $data->firstname.' '.$data->lastname, $data->get( 'id', 0 ) );

        $board->fill( $data->toArray() );

        $board->save();

        return $board;
    }
}