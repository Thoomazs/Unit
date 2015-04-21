<?php namespace App\Http\Controllers\PokerPlanning;

use App\Http\Requests\Request;
use App\Models\BoardRepository;
use App\Models\PokerPlanningRepository;
use App\Models\ProductRepository;
use App\Models\Type;
use App\Support\Controller as BaseController;

class HomeController extends BaseCOntroller
{

    protected $repo;

    function __construct( BoardRepository $repository, PokerPlanningRepository $poker )
    {
        parent::__construct();

        $this->repo  = $repository;
        $this->poker = $poker;
    }


    /**
     * Show Homepage
     *
     * @return Response
     */
    public function index()
    {
        $boards = $this->repo->poker()->all();

        return view( 'site.poker-planning.index', compact( 'boards' ) );

    }


    public function show( $slug )
    {
        $board = $this->repo->poker()->slug( $slug )->first();

        $buttonColor = $this->poker->getQuery()->where( "idUser", "=", $this->user )->where( "idStory", "=", $board->id )->first();

        if ( is_null( $board ) ) return;

        return view( 'site.poker-planning.show', compact( 'board' ), compact( 'buttonColor' ) );
    }

    public function vote( $slug, $value )
    {
        $board = $this->repo->poker()->slug( $slug )->first();
        $marked = $this->poker->getQuery()->where( "idUser", "=", $this->user )->where( "idStory", "=", $board->id )->first();

        if(!isset($marked)) {
            $data["idUser"] = $this->user;
            $data["idStory"] = $board->id;
            $data["value"] = $value;
            $data["ready"] = 0;

            $this->poker->create($data);
        } else {
            $this->poker->getQuery()->where( "idUser", "=", $this->user )->where( "idStory", "=", $board->id )->first()->update(array("value" => $value));
        }

        return redirect()->route( 'poker-planning.show', $slug );

    }

    public function ready($slug) {
        $board = $this->repo->poker()->slug( $slug )->first();
        $status = $this->poker->getQuery()->where( "idUser", "=", $this->user )->where( "idStory", "=", $board->id )->first();

        if(!isset($status))
            return;

        $this->poker->getQuery()->where( "idUser", "=", $this->user )->where( "idStory", "=", $board->id )->first()->update(array("ready" => 1));
        return redirect()->route( 'poker-planning.show', $slug);
    }

    public function lst($slug) {
        $board = $this->repo->poker()->slug( $slug )->first();

        $users = $this->poker->getQuery()->where("idStory", "=", $board->id)->where("ready", "=", 1)->first();

        return view( 'site.poker-planning.lst', compact( 'board' ) , compact("users"));

     }

    public function addBoard( Request $request )
    {
        $data                = $request->all();
        $data[ 'author_id' ] = $this->user;
        $data[ 'type_id' ]   = Type::whereName( 'Poker Planning' )->first()->id;

        $board = $this->repo->create( $data );

        return redirect()->route( 'poker-planning.show', $board->slug );
    }
}
