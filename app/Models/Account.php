<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
     protected $table = 'account'; // 👈 important since no underscore

    protected $fillable = [
        'reference_no',
        'account_code',
        'account_name',
        'account_classification',
    ];
}
