<?php namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class RegisterRequest extends Request
{
    public function rules()
    {
        return [ 'firstname' => 'required|min:2',
                 'lastname'  => 'required|min:2',
                 'email'     => 'required|email|unique:users',
                 'password'  => 'required|confirmed|min:8' ];
    }
}
