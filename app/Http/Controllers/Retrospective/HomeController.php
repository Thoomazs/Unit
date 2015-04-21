<?php namespace App\Http\Controllers\Retrospective;

use App\Http\Requests\Request;
use App\Models\BoardRepository;
use App\Models\ProductRepository;
use App\Models\Type;
use App\Support\Controller as BaseController;
use Symfony\Component\HttpKernel\Exception\HttpException;

class HomeController extends BaseController
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
        $boards = $this->repo->retrospective()->all();

        return view( 'site.retrospective.index', compact('boards') );
    }

    public function show( $slug )
    {
        $board = $this->repo->retrospective()->slug( $slug )->first();

        if( is_null($board)) return;

        return view( 'site.retrospective.show', compact('board') );
    }

    public function addBoard( Request $request )
    {
        $data              = $request->all();
        $data[ 'author_id' ]  = $this->user;
        $data[ 'type_id' ] = Type::whereName( 'Retrospektiva' )->first()->id;

        $board = $this->repo->create( $data );

        return redirect()->route( 'retrospective.show', $board->slug );
    }
}
