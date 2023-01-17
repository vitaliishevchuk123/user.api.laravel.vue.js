<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{

    protected $fillable = [
        'user_id',
        'file_name',
        'sort',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
    ];
}
