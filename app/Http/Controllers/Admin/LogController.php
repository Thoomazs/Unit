<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Models\LogRepository;
use Illuminate\Http\Request;

/**
 * Class LogController

 */
class LogController extends Controller
{
    /**
     * @param LogRepository $log
     */
    function __construct( LogRepository $log )
    {
        $this->repo = $log;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index( Request $request )
    {
        $s = $request->get( 's' );

        if ( $s ) $this->repo->search( $s );

        $logs = $this->repo->paginate();

        return view( "admin.log.index", compact( 'logs' ) );
    }
}
