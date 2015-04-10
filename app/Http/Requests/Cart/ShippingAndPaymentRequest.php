<?php namespace App\Http\Requests\Cart;

use App\Http\Requests\Request;

class ShippingAndPaymentRequest extends Request
{

    public function rules()
    {
        return [ 'payment_id'  => 'required:number',
                 'shipping_id' => 'required:number' ];
    }
}
