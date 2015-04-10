<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{

    protected $table = 'log';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ ];

    protected $fillable = [ 'level', 'message', 'ip', 'user_id', 'icon' ];

    public function user()
    {
        return $this->hasOne( 'App\Models\User', "id", "user_id" );
    }
}
