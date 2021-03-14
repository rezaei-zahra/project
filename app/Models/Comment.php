<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    //region model configs
    protected $table = 'comments';

    protected $fillable = [
        'user_id1', 'user_id2', 'parent_id', 'body' ,
    ];
    //endregion model configs

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
