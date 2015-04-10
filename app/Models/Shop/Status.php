<?php namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

    const ACTIVE = 1;

    const NEW_ORDER = 2;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'statuses';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ ];

    protected $fillable = [ 'name', 'desc' ];

}
