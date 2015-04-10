<?php namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ ];

    protected $fillable = [ 'firstname', 'lastname', 'email', 'phone', 'status_id', 'user_id', 'shipping_address_id', 'delivery_address_id', 'shipping_id', 'payment_id' ];


    public function status()
    {
        return $this->belongsTo( 'App\Models\Shop\Status' );
    }

    public function shipping()
    {
        return $this->belongsTo( 'App\Models\Shop\Shipping' );
    }

    public function payment()
    {
        return $this->belongsTo( 'App\Models\Shop\Payment' );
    }

    public function items()
    {
        return $this->hasMany( 'App\Models\Shop\Cart' );
    }

    public function getCountAttribute()
    {
        $count = 0;

        if ( count( $this->items ) > 0 )
        {
            foreach ( $this->items as $item )
            {
                $count += $item->quantity;
            }
        }

        return $count;
    }

    public function getItemPriceAttribute()
    {
        $price = 0;

        if ( count( $this->items ) > 0 )
        {
            foreach ( $this->items as $item )
            {
                $price += $item->price;
            }
        }

        return $price;
    }

    public function getPriceAttribute()
    {
        $price = 0;

        $price += $this->itemPrice;
        if($this->payment) $price += $this->payment->price;
        if($this->shipping) $price += $this->shipping->price;

        return $price;
    }

    public function user()
    {
        return $this->belongsTo( 'App\Models\User' );
    }

    public function __get( $key )
    {
        return ( $this->getAttribute( $key ) ) ?: $this->user->getAttribute( $key );
    }

    public function shippingAddress()
    {
        return $this->hasOne( 'App\Models\Address', "id", "shipping_address_id" );
    }

    public function getStreetAttribute()
    {
        return ( $this->shippingAddress ) ? $this->shippingAddress->street : null;
    }

    public function getCityAttribute()
    {
        return ( $this->shippingAddress ) ? $this->shippingAddress->city : null;
    }

    public function getPostcodeAttribute()
    {
        return ( $this->shippingAddress ) ? $this->shippingAddress->postcode : null;
    }

    public function getStateAttribute()
    {
        return ( $this->shippingAddress ) ? $this->shippingAddress->state : null;
    }

    public function billingAddress()
    {
        return $this->hasOne( 'App\Models\Address', "id", "billing_address_id" );
    }

    public function getBillingStreetAttribute()
    {
        return ( $this->billingAddress ) ? $this->billingAddress->street : null;
    }

    public function getBillingCityAttribute()
    {
        return ( $this->billingAddress ) ? $this->billingAddress->city : null;
    }

    public function getBillingPostcodeAttribute()
    {
        return ( $this->billingAddress ) ? $this->billingAddress->postcode : null;
    }

    public function getBillingStateAttribute()
    {
        return ( $this->billingAddress ) ? $this->billingAddress->state : null;
    }
}
