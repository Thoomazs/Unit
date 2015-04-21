<?php namespace App\Http\Controllers\PokerPlanning;

use App\Http\Requests\Request;
use App\Models\BoardRepository;
use App\Models\ProductRepository;
use App\Models\Type;
use App\Support\Controller as BaseController;

class HomeController extends BaseCOntroller
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
    public function index()
    {
        $boards = $this->repo->poker()->all();

        return view( 'site.poker-planning.index', compact('boards') );

    }


    public function show( $slug )
    {
        $board = $this->repo->poker()->slug( $slug )->first();

        if( is_null($board)) return;

        return view( 'site.poker-planning.show', compact('board') );
    }

    public function addBoard( Request $request )
    {
        $data              = $request->all();
        $data[ 'author_id' ]  = $this->user;
        $data[ 'type_id' ] = Type::whereName( 'Poker Planning' )->first()->id;

        $board = $this->repo->create( $data );

        return redirect()->route( 'poker-planning.show', $board->slug );
    }

}
