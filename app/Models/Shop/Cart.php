<?php namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cart';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ ];

    protected $fillable = [ 'price', 'quantity', 'product_id', 'order_id' ];

    public function order()
    {
        return $this->belongsTo( 'App\Models\Shop\Order' );
    }

    public function product()
    {
        return $this->belongsTo( 'App\Models\Product' );
    }

    public function getTotalPriceAttribute()
    {
        return $this->price * $this->quantity;
    }

    /**
     * Little hack to call missing attributes from Product model
     *
     * @param key
     */
    public function __get( $key )
    {
        return ( $this->getAttribute( $key ) ) ? : $this->product->getAttribute( $key );
    }
}
