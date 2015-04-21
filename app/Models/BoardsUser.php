<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoardsUser extends Model
{

    protected $table = 'boards_users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ ];

    protected $fillable = [ 'like', 'board_id', 'user_id', 'name', 'ready' ];

    public function board()
    {
        return $this->hasOne( 'App\Models\Board', "id", "board_id" );
    }

    public function author()
    {
        return $this->hasOne( 'App\Models\User', "id", "user_id" );
    }


}
