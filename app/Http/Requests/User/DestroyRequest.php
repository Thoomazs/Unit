<?php namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class DestroyRequest extends Request
{
    public function authorize()
    {
        return ( Input::get( 'id' ) != Auth::id() );
    }

    public function forbiddenResponse()
    {
        flash()->error( trans( 'messages.admin.Cant delete' ).' '.trans( 'messages.admin.Dont have permission' ) );

        return $this->response( [ ] );
    }
}
