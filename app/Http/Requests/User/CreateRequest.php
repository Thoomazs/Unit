<?php namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class CreateRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [ 'firstname' => 'required|alpha|min:2',
                 'lastname'  => 'required|alpha|min:2',
                 'email'     => 'required|email|unique:users',
                 'password'  => 'required|confirmed|min:8' ];
    }
}
