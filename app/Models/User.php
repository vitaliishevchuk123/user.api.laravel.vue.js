<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'surname',
        'position_id',
        'login',
        'birth',
        'sex',
        'role',
        'phone',
        'email',
        'password',
        'is_active',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function image(): HasOne
    {
        return $this->hasOne(UserImage::class)->withDefault();
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class)->withDefault();
    }

    public function getFullNameAttribute(): string
    {
        return implode(' ', array_filter([$this->name, $this->surname]));
    }

    public function getBirthDateAttribute(): string
    {
        return Carbon::parse($this->getAttribute('birth'))->format('d.m.Y');
    }

    public function getPhoneWithMaskAttribute(): string
    {

        return '+'.sprintf('%s (%s) %s-%s-%s',
            substr($this->getAttribute('phone'), 0, 2),
            substr($this->getAttribute('phone'), 2, 3),
            substr($this->getAttribute('phone'), 5, 3),
            substr($this->getAttribute('phone'), 8, 2),
            substr($this->getAttribute('phone'), 10)
        );
    }

    public function getSexNameAttribute(): string
    {
        if ($this->getAttribute('sex') == 1) {
            return 'Man';
        } elseif ($this->getAttribute('sex') == 2) {
            return 'Woman';
        }
        return '-';
    }
}
