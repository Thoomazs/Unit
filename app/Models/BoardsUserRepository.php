<?php namespace App\Models;

use App\Support\Repository;

/**
 * Class BoardUserRepository
 *
 * @package App\Http\Repositories
 */
class BoardsUserRepository extends Repository
{
    /**
     * Create a BoardUser repository instance.
     *
     * @param BoardUser $BoardUser
     *
     * @return void
     */
    function __construct( BoardsUser $BoardUser )
    {
        $this->model = $BoardUser;
    }

    /**
     * Add basic query
     *
     * @return $this
     */
    public function addBasicQuery()
    {
        return $this->getQuery()->with( 'user' )->with( 'board' )->orderBy( 'name', 'ASC' );
    }
}