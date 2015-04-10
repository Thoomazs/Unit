<?php namespace App\Http\Requests\Product;

use App\Http\Requests\Request;

class ProductRequest extends Request
{

    protected $dontFlash = [ 'image' ];

    public function rules()
    {
        return [ 'name'       => 'required|min:2',
                 'image'      => 'image',
                 'categories' => 'array' ];
    }
}
