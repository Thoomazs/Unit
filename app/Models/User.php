<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ 'password', 'remember_token' ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'firstname',
                            'lastname',
                            'email',
                            'password',
                            'slug', ];


    public function getNameAttribute()
    {
        return $this->firstname." ".$this->lastname;
    }

    public function setPasswordAttribute( $password )
    {
        $this->attributes[ 'password' ] = bcrypt( $password );
    }

    public function roles()
    {
        return $this->belongsToMany( 'App\Models\Role', "assigned_roles", "user_id", "role_id" );
    }


    public function boards()
    {
        return $this->belongsToMany( 'App\Models\Board', "boards_users", "user_id", "board_id" );
    }

    public function hasRole( $name )
    {
        foreach ( $this->roles as $role ) if ( $role->name == $name ) return true;

        return false;
    }
}
