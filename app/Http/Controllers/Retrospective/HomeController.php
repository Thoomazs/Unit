<?php namespace App\Http\Controllers\Retrospective;

use App\Http\Requests\Request;
use App\Models\Board;
use App\Models\BoardRepository;
use App\Models\BoardsUserRepository;
use App\Models\PostItRepository;
use App\Models\ProductRepository;
use App\Models\Type;
use App\Models\UserRepository;
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
    public function index( UserRepository $userRepository )
    {
        $boards = $userRepository->find( $this->user )->boards;

        return view( 'site.retrospective.index', compact( 'boards' ) );
    }

    /**
     * Show dashboard
     *
     * @param                  $slug
     * @param PostItRepository $postItRepository
     *
     * @return \Illuminate\View\View
     */
    public function show( $slug, PostItRepository $postItRepository, BoardsUserRepository $boardsUserRepository )
    {
        // get board
        $board = $this->repo->retrospective()->slug( $slug )->first();

        // if it not exist -> abort
        if ( is_null( $board ) ) \App::abort( 404 );

        // board users
        $boardUser = $boardsUserRepository->board( $board->id )->user( $this->user )->first();

        // generate form to add post-it
        $form = \FormBuilder::create( 'PostItForm', [ 'data' => [ 'board_id' => $board->id ] ] );

        // get all post-its
        $postIts        = $postItRepository->board( $board->id )->user( $this->user )->hidden()->all();
        $visiblePostIts = $postItRepository->board( $board->id )->user( $this->user )->visible()->all();

        return view( 'site.retrospective.show', compact( 'board', 'form', 'postIts', 'boardUser', 'visiblePostIts' ) );
    }

    /**
     * Join board
     *
     * @param                  $hash
     *
     * @return \Illuminate\View\View
     */
    public function invite( $hash )
    {
        // get board
        $board = $this->repo->retrospective()->hash( $hash )->first();

        // if it not exist -> abort
        if ( is_null( $board ) ) \App::abort( 404 );

        // if it is owner, just show
        if ( $this->user == $board->author_id || $board->hasUser( $this->user ) )
            return redirect()->route( 'retrospective.show', $board->slug );

        return view( 'site.retrospective.invite', compact( 'board' ) );
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function joinBoard( Request $request, BoardsUserRepository $boardUserRepository )
    {
        $data = $request->all();

        // get board
        $board = $this->repo->retrospective()->find( $data['board_id'] );

        // if it not exist -> abort
        if ( is_null( $board ) ) \App::abort( 404 );

        $data[ 'user_id' ] = $this->user;
        $data[ 'like' ]    = 5;

        $boardUserRepository->create( $data );

        return redirect()->route( 'retrospective.show', $board->slug );
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
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


    public function ready( $id, BoardsUserRepository $boardsUserRepository )
    {
        $data = [ 'id'    => $id,
                  'ready' => 1, ];

        $user = $boardsUserRepository->update( $data );

        // redirect to board
        return redirect()->route( 'retrospective.show', $user->board->slug );
    }

    /**
     * Add new post-it
     *
     * @param Request          $request
     * @param PostItRepository $postItRepository
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addPostIt( Request $request, PostItRepository $postItRepository )
    {
        // data
        $data              = $request->all();
        $data[ 'user_id' ] = $this->user;

        //create new post-it
        $postIt = $postItRepository->create( $data );

        // redirect to board
        return redirect()->route( 'retrospective.show', $postIt->board->slug );
    }

    /**
     * Publish post-it
     *
     * @param Request          $request
     * @param PostItRepository $postItRepository
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publishPostIt( $id, PostItRepository $postItRepository )
    {
        // get post id instance
        $postIt = $postItRepository->find( $id );

        // not exist
        if ( is_null( $postIt ) ) \App::abort( 404 );

        // not author
        if ( $postIt->user_id !== $this->user ) \App::abort( 501 );

        // delete
        $postItRepository->update( [ 'id' => $postIt->id, 'visible' => 1 ] );

        // redirect to board
        return redirect()->route( 'retrospective.show', $postIt->board->slug );
    }

    /**
     * Delete post-it
     *
     * @param                  $id
     * @param PostItRepository $postItRepository
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletePostIt( $id, PostItRepository $postItRepository )
    {
        // get post id instance
        $postIt = $postItRepository->find( $id );

        // not exist
        if ( is_null( $postIt ) ) \App::abort( 404 );

        // not author
        if ( $postIt->user_id !== $this->user ) \App::abort( 501 );

        // delete
        $postItRepository->delete( $postIt->id );

        // redirect to board
        return redirect()->route( 'retrospective.show', $postIt->board->slug );
    }
}
