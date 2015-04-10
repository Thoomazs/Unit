<?php namespace App\Http\Requests\Cart;

use App\Http\Requests\Request;

class DeliveryInformationRequest extends Request
{

    public function rules()
    {
        return [ 'firstname'        => 'required|min:2',
                 'lastname'         => 'required|min:2',
                 'email'            => 'required|email',
                 'phone'            => 'required|min:9',
                 'company'          => 'min:2',
                 'street'           => 'required|min:2',
                 'city'             => 'required|min:2',
                 'postcode'         => 'required|min:5',
                 'billing_company'  => 'min:2',
                 'billing_street'   => 'min:2',
                 'billing_city'     => 'min:2',
                 'billing_postcode' => 'min:5',
                 'billing_VAT'      => 'min:13', ];
    }
}
