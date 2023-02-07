<?php

namespace App\Models;


use App\Templates\TemplateModels\TemplateImageModel;

class UserImage extends TemplateImageModel
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
