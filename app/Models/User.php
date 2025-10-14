<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'reference_no',
        'username',
        'first',
        'middle',
        'last',
        'type',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays and JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Helper to get full name (optional, for display).
     */
    public function getFullNameAttribute(): string
    {
        return trim("{$this->first} {$this->middle} {$this->last}");
    }
}
