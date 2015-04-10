<?php namespace App\Http\Controllers\User;

use App\Http\Requests\Request;
use App\Models\UserRepository;
use App\Support\Controller;

class MyAccountController extends Controller
{

    protected $repo;

    function __construct( UserRepository $repository )
    {
        parent::__construct();

        $this->repo = $repository;
    }

    public function getProfile()
    {
        $user = $this->repo->getModel()->find( $this->user );

        if ( is_null( $user ) ) return redirect()->route( 'auth.login' );

        $form = \FormBuilder::create( 'App\Forms\User\EditForm', [ 'model' => $user ] );

        return view( 'site.users.profile', compact( 'user', 'form' ) );
    }

    public function postProfile( Request $request )
    {
        $this->repo->update( $request->all() );

        flash( trans( 'common.Updated' ) );

        return redirect()->route( 'my-account.profile' );
    }
}
