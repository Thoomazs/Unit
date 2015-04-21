<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostIt extends Model
{

    protected $table = 'postits';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ ];

    protected $fillable = [ 'type', 'text', 'board_id', 'user_id', 'like', 'visible' ];

    public function board()
    {
        return $this->hasOne( 'App\Models\Board', "id", "board_id" );
    }

    public function author()
    {
        return $this->hasOne( 'App\Models\User', "id", "author_id" );
    }
}
