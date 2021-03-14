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
    const TYPE_USER = 'کاربر';
    const TYPE_Doctor= 'پزشک';
    const TYPES = [self::TYPE_USER, self::TYPE_Doctor];
    //endregion types


//region model configs
    protected $table = 'users';
    protected $fillable = [
        'firstName',
        'lastName',
        'phoneNumber',
        'type',
        'email',
        'name',
        'password',
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

    public function listsicks()
    {
        return $this->hasManyThrough(
            User::class,
            ListSick::class,
            'user_id1',
            'id',
            'id',
            'user_id2' //
        );
    }
    //endregion relations

}
