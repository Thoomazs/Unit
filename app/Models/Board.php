<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{

    protected $table = 'boards';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ ];

    protected $fillable = [ 'name', 'slug', 'type_id' ];

    public function type()
    {
        return $this->hasOne( 'App\Models\Type', "id", "type_id" );
    }


}
