<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function createNewUser(array $data)
    {
        $data['password'] = bcrypt($data['password']);

        $user = $this->create($data);

        return $user;
    }

    public function getUserRole()
    {
        return Auth::user()->role;
    }

    public function isSuper()
    {
        if($this->getUserRole() == 5) {
            return true;
        }

        return false;
    }
}
