<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListSick extends Model
{
    use HasFactory;
    protected $table = 'list_sicks';

    protected $fillable = ['user_id1','user_id2','day'];
}
