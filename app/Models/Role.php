<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ ];

    protected $fillable = [ 'name' ];

    public function users()
    {
        return $this->belongsToMany( 'App\Models\User', 'assigned_roles', 'role_id', 'user_id' );
    }
}