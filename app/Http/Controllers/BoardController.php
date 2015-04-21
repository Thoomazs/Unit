<?php namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Models\BoardRepository;
use App\Models\BoardsUserRepository;
use App\Models\BoardUserRepository;
use App\Models\ProductRepository;
use App\Support\Controller as BaseController;

class BoardController extends BaseController
{

    protected $repo;

    function __construct( BoardRepository $repository )
    {
        parent::__construct();

        $this->repo = $repository;
    }


    /**
     * Show Homepage
     *
     * @return Response
     */
    public function addUser( Request $request, BoardsUserRepository $boardUserRepository )
    {
        $board = $this->repo->find( $request->get( 'board_id' ) );

        if ( is_null( $board ) ) App::abort( 404 );


        $data = [ 'user_id'  => $this->user,
                  'board_id' => $board->id,
                  'like'     => 5 ];

        $boardUserRepository->create( $data );

        if ( $board->type->name == 'Retrospektiva' ) return redirect()->route( 'retrospective.show', $board->slug );

        // TODO:
    }

}
