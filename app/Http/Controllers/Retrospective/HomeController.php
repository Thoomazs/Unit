<?php namespace App\Http\Controllers\Retrospective;

use App\Http\Requests\Request;
use App\Models\BoardRepository;
use App\Models\BoardsUserRepository;
use App\Models\PostItRepository;
use App\Models\ProductRepository;
use App\Models\Type;
use App\Support\Controller as BaseController;

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

        return view( 'site.retrospective.index', compact( 'boards' ) );
    }

    public function show( $slug, PostItRepository $postItRepository)
    {
        $board = $this->repo->retrospective()->slug( $slug )->first();

        if ( is_null( $board ) ) \App::abort( 404 );

        $form = \FormBuilder::create( 'PostItForm', [ 'data' => [ 'board_id' => $board->id ] ] );

        $postIts = $postItRepository->board($board->id)->all();

        return view( 'site.retrospective.show', compact( 'board', 'form', 'postIts' ) );
    }

    public function addBoard( Request $request, BoardsUserRepository $boardUserRepository )
    {
        $data                = $request->all();
        $data[ 'author_id' ] = $this->user;
        $data[ 'type_id' ]   = Type::whereName( 'Retrospektiva' )->first()->id;
        $data[ 'hash' ]      = sha1( uniqid( time() ) );

        $board = $this->repo->create( $data );

        $data = [ 'user_id'  => $this->user,
                  'name'     => 'Sprint owner',
                  'board_id' => $board->id,
                  'like'     => 5 ];

        $boardUserRepository->create( $data );

        return redirect()->route( 'retrospective.show', $board->slug );
    }

    public function addPostIt( Request $request, PostItRepository $postItRepository )
    {
        $board = $this->repo->retrospective()->find($request->get('board_id'));

        $data = $request->all();
        $data['user_id'] = $this->user;

        $postItRepository->create($data);

        return redirect()->route( 'retrospective.show', $board->slug );
    }
}
