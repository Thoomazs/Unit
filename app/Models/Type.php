<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{

    protected $table = 'boards_type';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ ];

    protected $fillable = [ 'name' ];

}
