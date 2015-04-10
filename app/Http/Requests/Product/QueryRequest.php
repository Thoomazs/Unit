<?php namespace App\Http\Requests\Product;

use App\Http\Requests\Request;

class QueryRequest extends Request
{

    public function rules()
    {
        return [ 'title' => 'required',
                 'text'  => 'required',
                 'email' => 'required|email' ];
    }
}
