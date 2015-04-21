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

    protected $fillable = [ 'name', 'slug', 'type_id', 'author_id', 'hash' ];

    public function type()
    {
        return $this->hasOne( 'App\Models\Type', "id", "type_id" );
    }

    public function author()
    {
        return $this->hasOne( 'App\Models\User', "id", "author_id" );
    }

    public function users()
    {
        return $this->belongsToMany( 'App\Models\User', "boards_users", "board_id", "user_id" );
    }

    public function hasUser( $id )
    {
        foreach ( $this->users as $user ) if ( $user->id == $id ) return true;

        return false;
    }
}
