<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    //region types
    const ROLE_USER = 'user';
    const ROLE_Doctor= 'doctor';
    const ROLES = [self::ROLE_USER, self::ROLE_Doctor];
    //endregion types


//region model configs
    protected $table = 'users';
    protected $fillable = [
        'firstName',
        'lastName',
        'phoneNumber',
        'role',
        'email',
        'password',
        'city',
        'specialty',
        'degree',
        'systemNumber',
        'address',

//        'verify_code',
//        'verify_at',
    ];

    protected $hidden = [
        'password',
//        'verify_code'
    ];

    //region relations
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function dayofweek()
    {
        return $this->hasOne(DayOfWeek::class);
    }

    public function favourites()
    {
        return $this->hasManyThrough(
            User::class,
            Favourite::class,
            'user_id1',
            'id',
            'id',
            'user_id2' //
        );
    }

//    public function listsicks()
//    {
//        return $this->hasManyThrough(
//            User::class,
//            ListSick::class,
//            'user_id2',
//            'id',
//            'id',
//            'user_id1' //
//        );
//    }



    public function listsicks()
    {
        return $this
            ->belongsToMany(User::class,'list_sicks','user_id2','user_id')
            ->withPivot('date')
            ->withTimestamps();
    }
    //endregion relations

}
