<?php namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'shippings';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ ];

    protected $fillable = [ ];

}
