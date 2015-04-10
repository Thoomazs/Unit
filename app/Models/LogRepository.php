<?php namespace App\Models;

use App\Support\Repository;

/**
 * Class LogRepository
 *
 * @package App\Http\Repositories
 */
class LogRepository extends Repository
{

    /**
     * Create a log repository instance.
     *
     * @param Log $log
     */
    function __construct( Log $log )
    {
        $this->model = $log;
    }

    /**
     * Add basic query
     *
     * @return $this
     */
    public function addBasicQuery()
    {
        $this->query = $this->getQuery()->with( "user" )->orderBy( "id", "DESC" );

        return $this;
    }


    /**
     * Search by message or created date
     *
     * @param $search
     *
     * @return $this
     */
    public function search( $search )
    {
        $this->query = $this->getQuery()->where( "message", "like", "%".$search."%" )->orWhere( "created_at", "like", "%".$search."%" )->orWhere( "id", "=", $search );

        return $this;
    }

}