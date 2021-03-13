<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;
    //region model configs
    protected $table = 'pages';
    protected $fillable = [
        'user_id',
        'name',
        'user_id',
        'city',
        'name',
        'specialty',
        'degree',
        'phone',
        'address',
        'workDay',
        'hoursWork',
    ];
    //endregion model configs

    //region model relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //endregion model relations
}
