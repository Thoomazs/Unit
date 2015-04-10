<?php namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    public function rules()
    {
        return [ 'firstname' => 'required|min:2',
                 'lastname'  => 'required|min:2',
                 'email'     => 'required|email|unique:users,email,'.$this->get( 'id' ),
                 'password'  => 'confirmed|min:8' ];
    }
}
