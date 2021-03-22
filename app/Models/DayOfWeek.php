<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayOfWeek extends Model
{
    use HasFactory;

    //region model configs
    protected $table = 'day_of_weeks';

    protected $fillable = [
        'Saturday',
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'user_id',
    ];
    //endregion model configs

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
