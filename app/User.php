<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPass;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'avatar','password','provider','provider_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }

  
    
    public function getAvatarUrl()
    {
        if ($this->photo_extension)
            return asset('images/users/'.$this->id.'.'.$this->photo_extension);
    
        return asset('images/users/default.jpg');
    }
}
