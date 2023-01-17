<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $fillable = [
        'uuid',
        'token',
        'expires_at',
        'created_at',
        'updated_at',
    ];
}
